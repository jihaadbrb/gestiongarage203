<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // $clients = Client::orderBy('id','desc')->take(5)->get();
        $clients = User::with('repairs')->orderBy('id', 'desc')->where('role', 'client')->get();
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.dashboard', ['clients' => $clients, 'mechanics' => $mechanics]);
    }

    public function destroy(User $client)
    {
        $client->delete();
        return
            redirect()->route('admin.dashboard');
    }

    public function edit(User $client)
    {
        return view('admin.edit', compact('client'));
    }
    public function update(Request $request, User $client)
    {

        $validationData = $request->validate([
            'name' => "required",
            'email' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required'
        ]);
        $client->update($validationData);
        return redirect()->route('admin.dashboard');
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
            redirect()->route('admin.dashboard');
    }

    public function showProfile(User $client)
    {


        // $client = User::with('vehicle')->find($client);
        
        return view('admin.profile', ['client' => $client]);
    }
}
