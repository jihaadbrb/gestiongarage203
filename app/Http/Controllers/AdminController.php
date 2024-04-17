<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Exists;

class AdminController extends Controller
{
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
        $vehicles = Vehicle::get();
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

}