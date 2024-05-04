<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;

class RepairController extends Controller
{
   
    public function showRepairs()
    {
        $repairs = Repair::with('user', 'vehicle')->get();
        return
            view('admin.management.repairs-data', ['repairs' => $repairs]);
    }


    public function storeRepair(Request $request)
    {
        // dd($request);
        $request->validate([
            'description' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after:startDate',  // Optional, validate after startDate
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'required|string',
            'user_id' => 'required',
            'mechanic_id' => 'required'
            // 'spare_parts_id'=>'required'
        ]);

        // Set default status if not provided in the request
        $status = $request->input('status', 'in_progress');

        // You can also use $request->filled('status') to check if status is provided

        $repairData = $request->all();
        $repairData['status'] = $status; // Set the status in the repair data
        $repairData['user_id'] = $request->get('user_id'); // Use route parameter if available, then form data
        $repairData['vehicle_id'] = $request->get('vehicle_id'); // Use route parameter if available, then form data
        $repairData['mechanic_id'] = $request->get('mechanic_id'); // Get mechanic ID from form
        // $repairData['spare_parts_id'] = $request->get('spare_parts_id'); // Get mechanic ID from form


        $repair = Repair::create($repairData);

        return redirect()->route('admin.repairs')->with('success', 'Repair record created successfully!');
    }


    public function fetchMechanics()
    {
        $mechanics = User::where('role', 'mechanic')->get();

        return response()->json([
            'mechanics' => $mechanics->toArray()
        ]);
    }

    public function destroyRepair(Request $request)
    {
        $repair = Repair::find($request->deleteId);
        // Check if $client exists before attempting to delete
        if ($repair) {
            $repair->delete();
            return "ok";
        } else {
            // Handle the case where $client is null
            return response()->json(['message' => 'repair not found'], 404);
        }
    }

    public function updateRepairStatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Update the status of the repair
        $repair = Repair::findOrFail($request->repair_id);
        $repair->status = $request->status;
        $repair->save();

        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }


}
