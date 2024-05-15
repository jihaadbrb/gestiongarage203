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
    public function lockScreen(Request $request)
    {
        // Invalidate the current session
        $email = Auth::user()->email;

        return view('admin.management.lock-screen', compact('email'));
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Login failed, redirect back with error message
        return back()->with('error', 'Incorrect email or password. Please try again.');
    }


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
    




    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);
    
        if ($request->hasFile('avatar')) {
            // Store the uploaded file
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
    
            // Update the authenticated user's avatar path in the database
            $user = auth()->user();
            $user->avatar = $avatarPath;
            $user->save();
            
            return back()->with('success', 'Avatar updated successfully.');
        }
    
        return back()->with('error', 'Failed to upload avatar.');
    }
    
}
