<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // $clients = Client::orderBy('id','desc')->take(5)->get();
        $clients = Client::all();

        return view('admin.dashboard', ['clients' => $clients]);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return
            redirect()->route('admin.dashboard');
    }

    public function edit(Client $client)
    {
        return view('admin.edit',compact('client'));
    }
    public function update(Request $request , Client $client){

        $validationData = $request ->validate([
            'firstName'=>"required",
            'lastName'=>'required' , 
            'address'=>'required' , 
            'phoneNumber'=>'required'
        ]);
        $client->update($validationData) ; 
        return redirect()->route('admin.dashboard');
    }
}
