<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;

use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class RepairController extends Controller
{

    public function getRepairs()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $repairs = Repair::with('user', 'vehicle')->get();
        }elseif($user->role === 'mechanic')
        {
           
            $repairs = Repair::where('mechanic_id', $user->id)
            ->with('user', 'vehicle')
            ->get();
 
       }else {
            $repairs = Repair::where('user_id', $user->id)->with('user', 'vehicle')->get();
        }
        $completedRepairsCount = Repair::where('status', 'completed')->count();
        return view('admin.management.repairs-data', ['repairs' => $repairs,'completedRepairsCount'=>$completedRepairsCount]);
    }



    public function CreateRepair(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'required|string',
            'user_id' => 'required',
            'mechanic_id' => 'required'
        ]);

        $status = $request->input('status', 'pending');

        $startDate = Carbon::now()->toDateString();

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



    public function getMechanicsList()
    {
        $mechanics = User::where('role', 'mechanic')->get();

        return response()->json([
            'mechanics' => $mechanics->toArray()
        ]);
    }

    public function DeleteRepair(Request $request)
    {
        $repair = Repair::find($request->rdeleteId);
        if ($repair) {
            $repair->delete();
            return "ok";
        } else {
            return response()->json(['message' => 'repair not found'], 404);
        }

        

    }


    public function RepairStatus(Request $request)
    {
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);
    
        $repair = Repair::findOrFail($request->repair_id);
    
        $repair->status = $request->status;
        $repair->save();
    
        if ($repair->status === 'completed') {
            if ($repair->user) {
                $message = "Your repair with ID: " . $repair->id . " is now marked as completed.";
                $notification = new Notification([
                    'user_id' => $repair->user->id,
                    "sender_id" => Auth::user()->email, 
                    'message' => $message,
                ]);
            $notification->save();
            }
        }
    
        return response()->json(['message' => 'Status updated successfully']);
    }
    


    
}
