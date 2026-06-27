<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send a notification to a user via multiple channels.
     */
    public static function send(User $user, $type, $title, $message, $data = [], $channels = ['database', 'email'])
    {
        // 1. Store in Database
        if (in_array('database', $channels)) {
            Notification::create([
                'user_id' => $user->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data
            ]);
        }

        // 2. Send Email
        if (in_array('email', $channels)) {
            try {
                // Placeholder for actual Mailable
                // Mail::to($user->email)->send(new \App\Mail\GeneralNotification($title, $message));
                Log::info("Email sent to {$user->email}: {$title}");
            } catch (\Exception $e) {
                Log::error("Failed to send email: " . $e->getMessage());
            }
        }

        // 3. Send SMS (Placeholder)
        if (in_array('sms', $channels)) {
            // Integration with Twilio/Msg91
            Log::info("SMS sent to {$user->phone}: {$message}");
        }

        // 4. Push Notification (Placeholder)
        if (in_array('push', $channels)) {
            // Integration with Firebase FCM
            Log::info("Push Notification sent to user {$user->id}: {$title}");
        }
    }

    /**
     * Notify Admin of new events
     */
    public static function notifyAdmin($title, $message, $data = [])
    {
        $admins = User::where('role', 'super_admin')->get();
        foreach ($admins as $admin) {
            self::send($admin, 'system', $title, $message, $data, ['database']);
        }
    }
}
