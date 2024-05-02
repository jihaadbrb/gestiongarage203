<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SparePart;
use App\Models\User;
use App\Models\Vehicle;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Exists;
use PDO;
use Symfony\Component\CssSelector\Node\FunctionNode;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{




    // public function showCharts()
    // {
    //     // Prepare data for the area chart
    //     $areaChartData = Repair::select(
    //             DB::raw('YEAR(created_at) as year'), 
    //             DB::raw('MONTH(created_at) as month'), 
    //             DB::raw('DAY(created_at) as day'), 
    //             DB::raw('COUNT(*) as total')
    //         )
    //         ->groupBy('year', 'month', 'day')
    //         ->orderByRaw('YEAR(created_at), MONTH(created_at), DAY(created_at)')
    //         ->get();
    
    //         // dd($areaChartData);
    //     return view('admin.dashboard', [
    //         'areaChartData' => $areaChartData,
    //     ]);
    // }
    
    
    
    
    





    public function showUsers()
    {
        $clients = User::with('repairs')->orderBy('id', 'desc')->where('role', 'client')->get();
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.management.users-data', ['clients' => $clients, 'mechanics' => $mechanics]);
    }

    public function showMechanics()
    {
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.management.mechanic-data', ['mechanics' => $mechanics]);
    }
    public function showAdmins()
    {
        $admins = User::orderBy('id', 'desc')->where('role', 'admin')->get();
        return view('admin.management.admin-data', ['admins' => $admins]);
    }

    public function destroy(Request $request)
    {
        $client = User::find($request->deleteId);
        // Check if $client exists before attempting to delete
        if ($client) {
            $client->delete();
            return "ok";
        } else {
            // Handle the case where $client is null
            return response()->json(['message' => 'User not found'], 404);
        }
    }


    public function edit(User $client)
    {
        return view('admin.users.edit-data', compact('client'));
    }
    public function update(Request $request, $id)
    {
        try {
            // Fetch the client using the provided ID
            $client = User::findOrFail($id);

            // Validate the incoming request data
            $validationData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $client->id,
                'address' => 'required',
                'phoneNumber' => 'required|string'
            ]);

            // Update the client's information with the validated data
            $client->update($validationData);

            // Redirect back to the previous page or any desired route
            return redirect()->back();
        } catch (QueryException $e) {
            // Handle the unique constraint violation exception
            return back()->withError('Email already exists.')->withInput();
        }
    }



    public function create()
    {
        return
            view('admin.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return
            redirect()->back();
    }
    public function showModal(Request $request)
    {
        // Retrieve the user ID from the request data
        $userId = $request->input('id');

        // Fetch the user information from the database along with their vehicles, repairs, and invoices
        $user = User::with(['vehicles', 'repairs', 'repairs.invoices'])->find($userId);
        // dd($user);
        // Check if user exists
        if ($user) {
            // Return the user information as JSON response
            return response()->json($user);
        } else {
            // If user is not found, return error response
            return response()->json(['error' => 'User not found.'], 404);
        }
    }


    public function showVehicles()
    {
        $vehicles = Vehicle::with('user')->get();
        // dd($vehicles);
        return
            view('admin.management.vehicles-data', ['vehicles' => $vehicles]);
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'registration' => ['required', 'string', 'max:255', 'unique:vehicles'],
            'user_id' => ['required', 'integer', 'exists:users,id'], // Check if user exists
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow multiple image uploads
        ]);

        $vehicleData = [
            'make' => $request->make,
            'model' => $request->model,
            'fuelType' => $request->fuelType,
            'registration' => $request->registration,
            'user_id' => $request->user_id,
        ];
        // Check if user exists (alternative approach)
        $user = User::find($request->user_id);
        if (!$user) {
            return back()->withErrors(['user_id' => 'Invalid user ID.']);
        }
        // Handle image uploads and add paths to vehicleData
        if ($request->hasFile('photos')) {
            $imagePaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('vehicle_photos'); // Assuming 'vehicle_photos' is your disk configuration for storing images
                $imagePaths[] = $path;
            }
            $vehicleData['photos'] = json_encode($imagePaths); // Encode paths as JSON
        }

        // Create vehicle instance with all data
        $vehicle = Vehicle::create($vehicleData);

        return redirect()->back(); // Or your desired redirection logic
    }

    public function showVehiclePics(Request $request)
    {
        $userId = $request->get('id');

        // Retrieve vehicle information for the user
        $vehicle = User::find($userId)->vehicles()->first(); // Assuming a 'vehicles' relationship

        if (!$vehicle) {
            return response()->json([], 404); // Not Found response if no vehicle found
        }

        // Extract image URLs from the vehicle data (modify based on your storage approach)
        $imageUrls = [];
        if (isset($vehicle->photos)) { // Assuming 'photos' field stores comma-separated paths
            $imageUrls = explode(',', $vehicle->photos);
        } else if (isset($vehicle->photo_paths)) { // Assuming 'photo_paths' field stores JSON-encoded paths
            $imageUrls = json_decode($vehicle->photo_paths, true);
        }

        // Handle scenarios where no image URLs are found
        if (empty($imageUrls)) {
            return response()->json([], 204); // No Content response for empty image urls
        }

        // dd($imageUrls);


        return response()->json(['pictures' => $imageUrls]);
    }


    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if (!$vehicle) {
            // If the vehicle doesn't exist, display an error message
            echo "The vehicle does not exist.";
            // You can also redirect the user back to the form with an error message if needed
            // return redirect()->back()->with('error', 'The vehicle does not exist.');
        } else {
            $request->validate([
                'make' => ['required', 'string', 'max:255'],
                'model' => ['required', 'string', 'max:255'],
                'fuelType' => ['required', 'string', 'max:255'],
                'registration' => ['required', 'string', 'max:255', 'unique:vehicles'],
                'user_id' => ['required', 'integer', 'exists:users,id'], // Check if user exists
                'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow multiple image uploads
            ]);

            $vehicleData = [
                'make' => $request->make,
                'model' => $request->model,
                'fuelType' => $request->fuelType,
                'registration' => $request->registration,
                'user_id' => $request->user_id,
            ];

            // Check if user exists
            $user = User::find($request->user_id);


            if ($request->hasFile('photos')) {
                $imagePaths = [];
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('vehicle_photos');
                    $imagePaths[] = $path;
                }
                $vehicleData['photos'] = json_encode($imagePaths);
            }

            $vehicle->update($vehicleData);
        }
    }


    public function destroyVehicle(Request $request)
    {
        $vehicle = Vehicle::find($request->deleteId);
        // Check if $client exists before attempting to delete
        if ($vehicle) {
            $vehicle->delete();
            return "ok";
        } else {
            // Handle the case where $client is null
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function showRepairs()
    {
        $repairs = Repair::with('user', 'vehicle')->get();
        return
            view('admin.management.repairs-data', ['repairs' => $repairs]);
    }


    public function storeRepair(Request $request)
    {
        // dd($request);
        $request->validate([
            'description' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after:startDate',  // Optional, validate after startDate
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'required|string',
            'user_id' => 'required',
            'mechanic_id' => 'required'
            // 'spare_parts_id'=>'required'
        ]);

        // Set default status if not provided in the request
        $status = $request->input('status', 'in_progress');

        // You can also use $request->filled('status') to check if status is provided

        $repairData = $request->all();
        $repairData['status'] = $status; // Set the status in the repair data
        $repairData['user_id'] = $request->get('user_id'); // Use route parameter if available, then form data
        $repairData['vehicle_id'] = $request->get('vehicle_id'); // Use route parameter if available, then form data
        $repairData['mechanic_id'] = $request->get('mechanic_id'); // Get mechanic ID from form
        // $repairData['spare_parts_id'] = $request->get('spare_parts_id'); // Get mechanic ID from form


        $repair = Repair::create($repairData);

        return redirect()->route('admin.repairs')->with('success', 'Repair record created successfully!');
    }


    public function fetchMechanics()
    {
        $mechanics = User::where('role', 'mechanic')->get();

        return response()->json([
            'mechanics' => $mechanics->toArray()
        ]);
    }

    public function destroyRepair(Request $request)
    {
        $repair = Repair::find($request->deleteId);
        // Check if $client exists before attempting to delete
        if ($repair) {
            $repair->delete();
            return "ok";
        } else {
            // Handle the case where $client is null
            return response()->json(['message' => 'repair not found'], 404);
        }
    }

    public function updateRepairStatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Update the status of the repair
        $repair = Repair::findOrFail($request->repair_id);
        $repair->status = $request->status;
        $repair->save();

        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }


    public function generateInvoice(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'additionalCharges' => 'required',
            'repair_id' => 'required'
        ]);

        // Calculate the total amount from the price of the spare parts and additional charges
        $additionalCharges = $validatedData['additionalCharges'];
        $repairId = $validatedData['repair_id'];

        $sparePartsTotal = SparePart::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId);
        })->sum('price');

        $totalAmount = $sparePartsTotal + $additionalCharges;

        // Create the invoice with the calculated total amount
        Invoice::create([
            'additionalCharges' => $additionalCharges,
            'totalAmount' => $totalAmount,
            'repair_id' => $repairId
        ]);

        return redirect()->back()->with('success', 'Invoice generated successfully.');
    }

    public function showInvoices()
    {
        $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')->get();
        return
            view('admin.management.invoices-data', ['invoices' => $invoices]);
    }

    public function showInvoiceModal(Request $request)
    {
        $invoiceId = $request->input('id');

        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle')->find($invoiceId);
        if ($invoice) {
            return response()->json($invoice);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function destroyInvoice(Request $request)
    {
        $invoice = Invoice::find($request->deleteId);
        if ($invoice) {
            $invoice->delete();
            return "ok";
        } else {
            return response()->json(['message' => "inoice not found"], 404);
        }
    }



    public function addSparePart(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'partName' => 'required|string',
            'partReference' => 'required|string',
            'supplier' => 'required|string',
            'price' => 'required|numeric',
            'repair_id' => 'required|exists:repairs,id', // Assuming repair_id is the ID of the repair related to the spare part
        ]);

        // Create a new SparePart instance
        $sparePart = new SparePart();
        $sparePart->partName = $validatedData['partName'];
        $sparePart->partReference = $validatedData['partReference'];
        $sparePart->supplier = $validatedData['supplier'];
        $sparePart->price = $validatedData['price'];
        $sparePart->save();

        // Attach the spare part to the repair using the pivot table
        $repair = Repair::find($validatedData['repair_id']);
        $repair->spareParts()->attach($sparePart->id);

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Spare part added successfully'], 200);
    }




    public function showSpareParts()
    {
        // Fetch spare parts along with their related repairs
        // $spareParts = Repair::with('spareParts')->get();
        $spareParts = SparePart::with('repairs')->get();
        // dd($spareParts);
        return view('admin.management.spareParts-data', ['spares' => $spareParts]);
    }

    public function destroySparePart(Request $request)
    {
        // Get the spare part ID from the request
        $sparePartId = $request->input('spare_part_id');

        // Find the spare part by ID
        $sparePart = SparePart::find($sparePartId);

        if (!$sparePart) {
            return response()->json(['message' => 'Spare part not found'], 404);
        }

        // Delete the spare part
        $sparePart->delete();

        return response()->json(['message' => 'Spare part deleted successfully'], 200);
    }
}
