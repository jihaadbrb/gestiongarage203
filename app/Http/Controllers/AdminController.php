<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function showUsers()
    {
        $clients = User::with('repairs')->orderBy('id', 'desc')->where('role', 'client')->get();
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.users.users-data', ['clients' => $clients, 'mechanics' => $mechanics]);
    }

    public function showMechanics()
    {
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.users.mechanic-data', ['mechanics' => $mechanics]);
    }
    public function showAdmins()
    {
        $admins = User::orderBy('id', 'desc')->where('role', 'admin')->get();
        return view('admin.users.admin-data', ['admins' => $admins]);
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

    public function showModalMechanic(Request $request)
    {
        $mechanicId = $request->input('id');
        $user = User::findOrFail($mechanicId);
        $data = [];

        // Include relationships based on the user's role
        if ($user->role === 'mechanic') {
            $mechanic = $user->load(['repairs.client', 'tasks', 'spareParts']);
            // Calculate performance metrics for the mechanic
            // Add other relevant data specific to mechanics
            $data['mechanic'] = $mechanic;
        } elseif ($user->role === 'user') {
            $userRepairs = $user->repairs()->with('mechanic')->get();
            // Add other relevant data specific to users
            $data['user_repairs'] = $userRepairs;
        } elseif ($user->role === 'admin') {
            // Handle admin specific data retrieval
        }

        return response()->json($data);
    }

    public function showVehicles(){
        return view('admin.users.vehicle-data');
    }

    public function storeVehicle(Request $request)
    {
        $validationData = $request->validate([
            'make' => ['required'],
            'modal' => ['required'],
            'fuelType' => ['required'],
            'registration' => ['required'],
            // 'photos' => ['nullable'],
            'user_id' => 'required'
        ]);

        // Create a new instance of the Vehicle model
        $vehicle = new Vehicle;

        // Assign the validated data to the model attributes
        $vehicle->make = $validationData['make'];
        $vehicle->modal = $validationData['modal'];
        $vehicle->fuelType = $validationData['fuelType'];
        $vehicle->registration = $validationData['registration'];
        $vehicle->user_id = $validationData['user_id'];

        // Save the vehicle to the database
        $vehicle->save();
        // dd($vehicle);
        // Optionally, you can return a response or redirect to a success page
        return response()->json(['message' => 'Vehicle stored successfully']);
    }
}
