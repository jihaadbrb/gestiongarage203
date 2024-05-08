<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
   
    public function showRepairs()
{
    $user = Auth::user();

    // Check if the user is an admin
    if ($user->role === 'admin') {
        // Admin can see all repairs
        $repairs = Repair::with('user', 'vehicle')->get();
    } else {
        // User can only see their own repairs
        $repairs = Repair::where('user_id', $user->id)->with('user', 'vehicle')->get();
    }

    return view('admin.management.repairs-data', ['repairs' => $repairs]);
}



public function storeRepair(Request $request)
{
    $request->validate([
        'description' => 'required',
        'mechanicNotes' => 'nullable|string',
        'clientNotes' => 'required|string',
        'user_id' => 'required',
        'mechanic_id' => 'required'
    ]);

    // Set default status if not provided in the request
    $status = $request->input('status', 'pending');

    // Set startDate to current date
    $startDate = Carbon::now()->toDateString();

    // Set endDate if status is 'complete'
    $endDate = null;
    if ($status === 'complete') {
        $endDate = Carbon::now()->toDateString();
    }

    $repairData = $request->all();
    $repairData['status'] = $status;
    $repairData['startDate'] = $startDate;
    $repairData['endDate'] = $endDate;
    $repairData['user_id'] = $request->get('user_id');
    $repairData['vehicle_id'] = $request->get('vehicle_id');
    $repairData['mechanic_id'] = $request->get('mechanic_id');

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
