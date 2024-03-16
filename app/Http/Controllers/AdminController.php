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
        $clients = Client::with('user')->get();

return view('users.index', compact('clients'));
    }
    public function destroy(User $client)
    {
        $client->delete();
        return
            redirect(route('users.index'));
    }
}
