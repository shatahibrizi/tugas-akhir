<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markAsRead(Request $request)
    {
        Log::info('markAsRead function called'); // Tambahkan log ini
        Log::info('CSRF Token Received:', ['csrf_token' => $request->header('X-CSRF-TOKEN')]);

        $user = Auth::user();
        if ($user) {
            $user->unreadNotifications->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 401);
    }
}
