<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;    
use App\Models\User;

use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
   


    public function importUsers(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (\Exception $e) {
            // Catch any exceptions that occur during the import process
            session()->flash('error', 'Error importing users: ' . $e->getMessage());
            return redirect()->back();
        }
    
        // If the import is successful, redirect to the admins page
        session()->flash('success', '__(Users imported successfully)');
        return redirect(route('admin.admins'));
    }
    





    
}
