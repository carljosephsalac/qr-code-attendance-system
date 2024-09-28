<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserQrCode extends Controller
{
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->latest()->get();

        foreach ($users as $user) {
            // Create a URL to the user page with automatic login
            $loginUrl = route('users.inOut', ['user' => $user->id]);

            // Include user details and the login URL in the QR code
            $userDetails = "{$loginUrl}\nID: {$user->id}\nName: {$user->name}\nEmail: {$user->email}";
            $user->qrCode = QrCode::size(250)->generate($userDetails);
        }

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $validated['type'] = 'user';

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Created Successfully');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function inOut(User $user)
    {
        // Get the latest scan record for the user
        $scan = $user->scan()->latest()->first();

        // Get the current timestamp and today's date
        $currentTime = now()->format('g:i A');
        $today = now()->format('Y-m-d');

        if ($scan) {
            // Check if the scan date is today
            $scanDate = $scan->created_at->format('Y-m-d');

            // Check if both time_in and time_out already have values for today
            if ($scanDate === $today && $scan->time_in && $scan->time_out) {
                $message = 'Time in and Time out are already recorded for today';

            } elseif ($scanDate === $today && $scan->time_in) {
                // Update time_out if only time_in is set for today
                $scan->time_out = $currentTime;
                $scan->save();
                $message = 'Time out successfully';

            } else {
                // If it's a new day, create a new record with time_in
                $scan = $user->scan()->create([
                    'user_id' => $user->id,
                    'time_in' => $currentTime
                ]);
                $message = 'Time in successfully';
            }

        } else {
            // If no scan record exists, create a new one with time_in
            $scan = $user->scan()->create([
                'user_id' => $user->id,
                'time_in' => $currentTime
            ]);
            $message = 'Time in successfully';
        }

        return view('users.notification-page', compact('message'));
    }


    public function showUserPage()
    {
        $user = Auth::user();

        $scans = $user->scan()->latest()->get();

        return view('users.user-page', compact('user', 'scans'));
    }

}
