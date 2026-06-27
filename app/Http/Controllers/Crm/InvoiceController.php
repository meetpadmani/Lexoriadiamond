<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() { return view('crm.invoices.index'); }
    public function create() { return view('crm.invoices.create'); }
    public function store(Request $request) { return redirect()->route('crm.invoices.index')->with('success', 'Invoice created.'); }
    public function show($invoice) { return view('crm.invoices.show', ['invoice' => (object)['id' => $invoice]]); }
    public function edit($invoice) { return view('crm.invoices.edit', ['invoice' => (object)['id' => $invoice]]); }
    public function update(Request $request, $invoice) { return redirect()->route('crm.invoices.index')->with('success', 'Invoice updated.'); }
    public function destroy($invoice) { return redirect()->route('crm.invoices.index')->with('success', 'Invoice deleted.'); }
    public function pdf($invoice) { return back(); }
}
