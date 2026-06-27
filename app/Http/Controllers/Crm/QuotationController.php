<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index() { return view('crm.quotations.index'); }
    public function create() { return view('crm.quotations.create'); }
    public function store(Request $request) { return redirect()->route('crm.quotations.index')->with('success', 'Quotation created.'); }
    public function show($quotation) { return view('crm.quotations.show', ['quotation' => (object)['id' => $quotation]]); }
    public function edit($quotation) { return view('crm.quotations.edit', ['quotation' => (object)['id' => $quotation]]); }
    public function update(Request $request, $quotation) { return redirect()->route('crm.quotations.index')->with('success', 'Quotation updated.'); }
    public function destroy($quotation) { return redirect()->route('crm.quotations.index')->with('success', 'Quotation deleted.'); }
    public function pdf($quotation) { return back(); }
    public function send(Request $request, $quotation) { return back()->with('success', 'Quotation sent.'); }
}
