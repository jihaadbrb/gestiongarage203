<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function showVehicles()
    {
        $user = Auth::user();
    
        // Check if the user is an admin
        if ($user->role === 'admin') {
            // Admin can see all vehicles
            $vehicles = Vehicle::with('user')->get();
        } elseif ($user->role === 'mechanic') {
            // Mechanic can see vehicles associated with their repairs
            $vehicles = Vehicle::whereHas('repairs', function ($query) use ($user) {
                $query->where('mechanic_id', $user->id);
            })->with('user', 'repairs', 'repairs.mechanic')->get();
        
            // Additionally, get the vehicles directly associated with the mechanic
            $mechanicVehicles = Vehicle::where('user_id', $user->id)->get();
        
            // Merge the two collections if needed
            $vehicles = $vehicles->merge($mechanicVehicles);
        }
        
         else {
            // User can only see vehicles associated with their account
            $vehicles = Vehicle::where('user_id', $user->id)->with('user')->get();
        }
    
        // Pass the $vehicles variable to the view
        return view('admin.management.vehicles-data', ['vehicles' => $vehicles, 'vehicle' => $vehicles->first()]);
    }
    



    public function storeVehicle(Request $request)
    {
        $request->validate([
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'registration' => ['required', 'string', 'max:255', 'unique:vehicles'],
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow multiple image uploads
        ]);

        // Initialize vehicleData array
        $vehicleData = [
            'make' => $request->make,
            'model' => $request->model,
            'fuelType' => $request->fuelType,
            'registration' => $request->registration,
            'user_id' => $request->user_id ?? auth()->id(), // Use provided user_id or fallback to authenticated user's ID
        ];

        // Check if user exists (alternative approach)
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            if (!$user) {
                return back()->withErrors(['user_id' => 'Invalid user ID.']);
            }
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
}
