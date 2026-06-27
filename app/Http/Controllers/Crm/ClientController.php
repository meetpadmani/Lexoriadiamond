<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::whereNotNull('email_verified_at')
            ->where('is_admin', '!=', 1)
            ->latest()->paginate(20);
        return view('crm.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('crm.clients.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('crm.clients.index')->with('success', 'Client created successfully.');
    }

    public function show($client)
    {
        $clientModel = User::findOrFail($client);
        return view('crm.clients.show', ['client' => $clientModel]);
    }

    public function edit($client)
    {
        $clientModel = User::findOrFail($client);
        return view('crm.clients.edit', ['client' => $clientModel]);
    }

    public function update(Request $request, $client)
    {
        return redirect()->route('crm.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($client)
    {
        return redirect()->route('crm.clients.index')->with('success', 'Client deleted.');
    }

    public function uploadDocument(Request $request, $client)
    {
        return back()->with('success', 'Document uploaded.');
    }

    public function deleteDocument($client, $document)
    {
        return back()->with('success', 'Document deleted.');
    }
}
