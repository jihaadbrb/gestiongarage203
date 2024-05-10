<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
        $appointment->status = $request->status;
        $appointment->save();
    
        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }
    

}
