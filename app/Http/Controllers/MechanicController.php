<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class MechanicController extends Controller
{
    public function getMechanics()
    {
        $mechanics = User::orderBy('id', 'desc')->where('role', 'mechanic')->get();
        return view('admin.management.mechanic-data', ['mechanics' => $mechanics]);
    }
}
