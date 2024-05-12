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

    public function showRepairs()
    {
        $user = Auth::user();

        // Check if the user is an admin
        if ($user->role === 'admin') {
            // Admin can see all repairs
            $repairs = Repair::with('user', 'vehicle')->get();
        }elseif($user->role === 'mechanic')
        {
            $repairs = Repair::where('mechanic_id', $user->id)
            ->with('user', 'vehicle')
            ->get();
       }else {
            // User can only see their own repairs
            $repairs = Repair::where('user_id', $user->id)->with('user', 'vehicle')->get();
        }
        $completedRepairsCount = Repair::where('status', 'completed')->count();
        return view('admin.management.repairs-data', ['repairs' => $repairs,'completedRepairsCount'=>$completedRepairsCount]);
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
        $repair = Repair::find($request->rdeleteId);
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
    
        // Find the repair by ID
        $repair = Repair::findOrFail($request->repair_id);
    
        // Update the status of the repair
        $repair->status = $request->status;
        $repair->save();
    
        // If the new status is 'completed' and the old status was not 'completed'
        if ($repair->status === 'completed') {
            // Ensure that the repair has a user associated with it
            if ($repair->user) {
                // Create a notification for the user
                $message = "Your repair with ID: " . $repair->id . " is now marked as completed.";
                $notification = new Notification([
                    'user_id' => $repair->user->id,
                    "sender_id" => Auth::user()->email, // Assuming sender_id should be user's id
                    'message' => $message,
                ]);
            $notification->save();
            }
        }
    
        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }
    


    public function showNotifications()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Check if the user is authenticated
        if ($user) {
            // Fetch notifications for the authenticated user, ordered by created_at in descending order
            $notifications = $user->notifications()
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'sender' => $notification->sender_id,
                        'message' => $notification->message,
                        'created_at' => $notification->created_at->format('Y-m-d H:i:s'),
                        'user' => [
                            'name' => $notification->user->name,
                            'email' => $notification->user->email,
                        ],
                    ];
                });
    
            // Return a JSON response with the notifications data
            return response()->json([
                'notifications' => $notifications,
            ]);
        } else {
            // Handle case where user is not authenticated
            return response()->json(['error' => 'Unauthenticated user'], 401);
        }
    }
    



//     public function showNotifications()
// {
//     // Get the authenticated user
//     $user = Auth::user();

//     // Check if the user is authenticated
//     if ($user) {
//         // Fetch notifications for the authenticated user
//         $notificationsData = [];
//         foreach ($user->notifications as $notification) {
//             // Extract the required information from each notification
//             $notificationData = [
//                 'id' => $notification->id,
//                 'sender' => $notification->sender_id,
//                 'message' => $notification->message,
//                 'created_at' => $notification->created_at->format('Y-m-d H:i:s'),
//             ];

//             // Add the notification data to the array
//             $notificationsData[] = $notificationData;
//         }

//         // Fetch user sender information
//         $userSenders = [];
//         foreach ($notificationsData as $notificationData) {
//             $senderId = $notificationData['data']['sender_id'];
//             $userSender = User::find($senderId);
//             if ($userSender) {
//                 // Extract the required information from the sender user
//                 $senderData = [
//                     'name' => $userSender->name,
//                     'email' => $userSender->email,
//                 ];
//                 // Add the sender data to the array
//                 $userSenders[$notificationData['id']] = $senderData;
//             }
//         }

//         // Return a JSON response with the notifications data and user sender information
//         return response()->json([
//             'notifications' => $notificationsData,
//             'user_senders' => $userSenders,
//         ]);
//     } else {
//         // Handle case where user is not authenticated
//         return response()->json(['error' => 'Unauthenticated user'], 401);
//     }
// }

}
