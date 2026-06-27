<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(15);
        return view('crm.leads.index', compact('leads'));
    }

    public function kanban()
    {
        return view('crm.leads.kanban');
    }

    public function create()
    {
        return view('crm.leads.create');
    }

    public function store(Request $request)
    {
        // Add validation and saving logic
        return redirect()->route('crm.leads.index')->with('success', 'Lead created successfully.');
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('crm.leads.show', compact('lead'));
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('crm.leads.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        // Add validation and updating logic
        return redirect()->route('crm.leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return redirect()->route('crm.leads.index')->with('success', 'Lead deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        // update status logic
        return back()->with('success', 'Lead status updated.');
    }

    public function convert(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        // convert to client logic
        return back()->with('success', 'Lead converted to client.');
    }

    public function addActivity(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        // add activity logic
        return back()->with('success', 'Activity added.');
    }
}
