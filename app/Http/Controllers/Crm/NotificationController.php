<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() { return view('crm.notifications.index'); }
    public function markRead($notification) { return back()->with('success', 'Marked as read.'); }
    public function markAllRead() { return back()->with('success', 'All notifications marked as read.'); }
    public function unreadCount() { return response()->json(['count' => 0]); }
}
