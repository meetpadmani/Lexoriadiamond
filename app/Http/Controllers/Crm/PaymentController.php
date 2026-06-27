<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() { return view('crm.payments.index'); }
    public function create() { return view('crm.payments.create'); }
    public function store(Request $request) { return redirect()->route('crm.payments.index')->with('success', 'Payment recorded.'); }
    public function show($payment) { return view('crm.payments.show', ['payment' => (object)['id' => $payment]]); }
    public function destroy($payment) { return redirect()->route('crm.payments.index')->with('success', 'Payment deleted.'); }
}
