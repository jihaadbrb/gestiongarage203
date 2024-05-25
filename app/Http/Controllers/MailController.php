<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Models\User;
use App\Models\Repair;
use App\Models\SentEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function showMails()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $emails = SentEmail::with('user')->get();
        } else {
            $emails = SentEmail::where('user_id', $user->id)->with('user')->get();
        }
    
        return view('admin.management.mail-data', ['emails' => $emails]);
    }
    
    public function index(Request $request)
    {

        $repairId = $request->query('repair_id');
        $locale = App::getLocale();
        $user = User::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId)
                ->where('status', 'completed');
        })->first();

        if ($user) {
            $repair = Repair::find($repairId);

            $mailData = [
                'title' => 'Repair Completed Notification',
                'description' => $repair->description,
                'dateCompleted' => Carbon::parse($repair->endDate)->format('Y-m-d'),
            ];

            Mail::to($user->email)->send(new DemoMail($mailData,$locale));

            $sentEmail = new SentEmail([
                'recipient' => $user->email,
                'subject' => $mailData['title'],
                'body' => $mailData['description'],
                'user_id' => $user->id,
                'sent_at' => now(),
            ]);
            $sentEmail->save();
            return redirect()->back()->with('success', 'Email has been sent successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found or repair is not completed.');
        }
    }

    public function sendAll()
    {
        $users = User::with('repairs')->whereHas('repairs', function ($query) {
            $query->where('status', 'completed');
        })->get();
        $locale = App::getLocale();

        foreach ($users as $user) {
            foreach ($user->repairs as $repair) {
                $mailData = [
                    'title' => 'Repair Completed Notification',
                    'description' => $repair->description,
                    'dateCompleted' => Carbon::parse($repair->endDate)->format('Y-m-d'),
                ];

                Mail::to($user->email)->send(new DemoMail($mailData,$locale));

                $sentEmail = new SentEmail([
                    'recipient' => $user->email,
                    'subject' => $mailData['title'],
                    'body' => $mailData['description'],
                    'user_id' => $user->id,
                    'sent_at' => now(),
                ]);
                $sentEmail->save();
            }
        }
        return redirect()->back()->with('success',__('Emails have been sent successfully.'));
    }


    public function sendEmail(Request $request)
    {
        $locale = App::getLocale();

        $mailData = [
            'title' => $request->input('title'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        Mail::to($mailData['title'])->send(new DemoMail($mailData, $locale));

        session()->flash('success', __('Mail sent successfully'));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
