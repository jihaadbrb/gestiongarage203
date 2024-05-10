<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        if(Auth::user()->role==="admin"){
        $appointments = Appointment::orderBy('appointment_time', 'asc')->with('user')->get();
    }else{
        $appointments = Appointment::where('user_id', auth()->id())->orderBy('appointment_time', 'asc')->with('user')->get();
    }

        return 
            view('admin.management.appointments-data',compact('appointments'));
    }

    public function store(Request $request)
    {
        // dd($request); 

        $appointment = Appointment::create([
            'user_id' =>$request->user_id ?? auth()->id(),
            'description' =>$request->description,
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'status'=>'pending'
        ]);

        return redirect()->back();
    }


    public function distroy(Request $request)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($request->deleteId);

    

        if($appointment){
            $appointment->delete();
            return "ok";
        }else{
            return response()->json(['message' => 'appointment not found'], 404);
        }
    }
    public function updateAppointmentStatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,completed,canceled'
        ]);
    
        // Check if the user has permission to update the appointment
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        // Update the status of the appointment
        $appointment = Appointment::findOrFail($request->appointment_id);
    
        // Check if the status is changing to confirmed and it wasn't confirmed before
        if ($appointment->status !== 'confirmed' && $request->status === 'confirmed') {
            // Create a notification for the user associated with the appointment
            $message = "Your appointment with ID: " . $appointment->id . " has been confirmed.";
            $notification = new Notification([
                'user_id' => $appointment->user_id,
                "sender_id" => Auth::user()->email,
                'message' => $message,
            ]);
            $notification->save();
        } elseif ($appointment->status !== 'completed' && $request->status === 'completed') {
            // Create a notification for the user associated with the appointment
            $message = "Your appointment with ID: " . $appointment->id . " has been completed.";
            $notification = new Notification([
                'user_id' => $appointment->user_id,
                "sender_id" => Auth::user()->email,
                'message' => $message,
            ]);
            $notification->save();
        } elseif ($appointment->status !== 'canceled' && $request->status === 'canceled') {
            // Create a notification for the user associated with the appointment
            $message = "Your appointment with ID: " . $appointment->id . " has been canceled.";
            $notification = new Notification([
                'user_id' => $appointment->user_id,
                "sender_id" => Auth::user()->email,
                'message' => $message,
            ]);
            $notification->save();
        }
    
        $appointment->status = $request->status;
        $appointment->save();
    
        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }
    
    
    // public function showNotifications()
    // {
    //     // Get the authenticated user
    //     $user = Auth::user();
        
    //     // Check if the user is authenticated
    //     if ($user) {
    //         // Fetch notifications for the authenticated user, ordered by created_at in descending order
    //         $notifications = $user->notifications()
    //             ->orderBy('created_at', 'desc')
    //             ->get()
    //             ->map(function ($notification) {
    //                 return [
    //                     'id' => $notification->id,
    //                     'sender' => $notification->sender_id,
    //                     'message' => $notification->message,
    //                     'created_at' => $notification->created_at->format('Y-m-d H:i:s'),
    //                     'user' => [
    //                         'name' => $notification->user->name,
    //                         'email' => $notification->user->email,
    //                     ],
    //                 ];
    //             });
    
    //         // Return a JSON response with the notifications data
    //         return response()->json([
    //             'notifications' => $notifications,
    //         ]);
    //     } else {
    //         // Handle case where user is not authenticated
    //         return response()->json(['error' => 'Unauthenticated user'], 401);
    //     }
    // }

}
