<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  

    public function getUsers()
    {
       
        if (Auth::user()->role === "admin") {
            $clients = User::with('repairs')->orderBy('id', 'desc')->where('role', 'client')->get();
            $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        } elseif (Auth::user()->role === "mechanic") {
            $clients = User::orderBy('id', 'desc')->where('role', 'mechanic')->where('id', Auth::id())->get();
            $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        }
        else {
            $clients = User::with('repairs')->orderBy('id', 'desc')->where('role', 'client')->where('id', Auth::id())->get();
            $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        }

        return view('admin.management.users-data', ['clients' => $clients, 'mechanics' => $mechanics]);
    }

    public function DeleteUser(Request $request)
    {
        $client = User::find($request->cdeleteId);
        // Check if $client exists before attempting to delete
        if ($client) {
            $client->notifications()->delete();
            $client->delete();

            return "ok";
        } else {
            // Handle the case where $client is null
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function edit (User $client)
    {
        return view('admin.users.edit-data', compact('client'));
    }

    public function StoreUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
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

    public function UpdateUser(Request $request, $clientId)
    {
        try {
            // Fetch the client using the provided ID
            $client = User::findOrFail($clientId);
    
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
    
        } catch (ModelNotFoundException $e) {
            // Handle the case where the client is not found
            return redirect(route('admin.dashboard'))->with("success", "User not found");
    
        } catch (QueryException $e) {
            // Handle the unique constraint violation exception
            return back()->withError('Email already exists.')->withInput();
        }

        
    }

    public function importUsers(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (\Exception $e) {
            session()->flash('error', 'Error importing users: ' . $e->getMessage());
            return redirect()->back();
        }
    
        return redirect(route('admin.admins'));
    }

    
    
}
