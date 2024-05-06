<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Models\User;
use App\Models\Repair;
use Carbon\Carbon;

class MailController extends Controller
{
    public function showMails()
    {
        return
            view('admin.management.mail-data');
    }
    public function index(Request $request)
    {

        // Retrieve the repair ID from the request
        $repairId = $request->query('repair_id');

        // Find the user associated with the completed repair
        $user = User::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId)
                ->where('status', 'completed');
        })->first();

        // Check if user is found
        if ($user) {
            $repair = Repair::find($repairId);
            $description = $repair->description;
            $dateCompleted = Carbon::parse($repair->endDate)->format('Y-m-d');

            $mailData = [
                'title' => 'Repair Completed Notification',
                'description' => $repair->description,
                'dateCompleted' => Carbon::parse($repair->endDate)->format('Y-m-d'),
            ];

            // Send email to the selected user
            Mail::to($user->email)->send(new DemoMail($mailData));

            return redirect()->back()->with('success', 'Email has been sent successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found or repair is not completed.');
        }
    }
}
