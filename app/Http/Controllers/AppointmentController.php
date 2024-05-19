<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function getAppointements()
    {
        if(Auth::user()->role==="admin"){
        $appointments = Appointment::orderBy('appointment_time', 'asc')->with('user')->get();
    }else{
        $appointments = Appointment::where('user_id', auth()->id())->orderBy('appointment_time', 'asc')->with('user')->get();
    }

        return 
            view('admin.management.appointments-data',compact('appointments'));
    }

    public function CreateAppointements(Request $request)
    {


        $appointment = Appointment::create([
            'user_id' =>$request->user_id ?? auth()->id(),
            'description' =>$request->description,
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'status'=>'pending'
        ]);

        return redirect()->back();
    }


    public function DeleteAppointement(Request $request)
    {
        $appointment = Appointment::find($request->deleteId);



        if($appointment){
            $appointment->delete();
            return "ok";
        }else{
            return response()->json(['message' => 'appointment not found'], 404);
        }
    }
    public function EditStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,completed,canceled'
        ]);
    
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        $appointment = Appointment::findOrFail($request->appointment_id);
    
        if ($appointment->status !== 'confirmed' && $request->status === 'confirmed') {
            $message = "Your appointment with ID: " . $appointment->id . " has been confirmed.";
            $notification = new Notification([
                'user_id' => $appointment->user_id,
                "sender_id" => Auth::user()->email,
                'message' => $message,
            ]);
            $notification->save();
        } elseif ($appointment->status !== 'completed' && $request->status === 'completed') {
            $message = "Your appointment with ID: " . $appointment->id . " has been completed.";
            $notification = new Notification([
                'user_id' => $appointment->user_id,
                "sender_id" => Auth::user()->email,
                'message' => $message,
            ]);
            $notification->save();
        } elseif ($appointment->status !== 'canceled' && $request->status === 'canceled') {
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
    
        return response()->json(['message' => 'Status updated successfully']);
    }
    
    


}
