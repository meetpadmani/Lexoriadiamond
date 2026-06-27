<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function index() { return view('crm.whatsapp.index'); }
    public function conversations() { return response()->json([]); }
    public function conversation($conversation) { return response()->json([]); }
    public function send(Request $request) { return response()->json(['success' => true]); }
    public function webhook(Request $request) { return response()->json(['success' => true]); }
}
