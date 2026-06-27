@extends('crm.layout')
@section('title', 'Clients')
@section('content')
<div class="crm-page-header">
    <div>
        <h2 class="crm-page-title">Clients</h2>
        <p class="crm-page-subtitle">Manage your client relationships</p>
    </div>
</div>
<div class="crm-card">
    <div class="crm-card-header">
        <h5><i class="bi bi-people-fill me-2 text-primary"></i>All Clients</h5>
    </div>
    @if($clients->count())
    <div class="table-responsive">
        <table class="crm-table">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td><div class="d-flex align-items-center gap-2"><div class="crm-avatar-sm">{{ strtoupper(substr($client->name,0,1)) }}</div>{{ $client->name }}</div></td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone ?? '—' }}</td>
                    <td>{{ $client->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('crm.clients.show', $client->id) }}" class="crm-btn crm-btn-sm crm-btn-outline"><i class="bi bi-eye"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $clients->links() }}</div>
    @else
    <div class="crm-empty-state">
        <i class="bi bi-people"></i>
        <h5>No Clients Yet</h5>
        <p>Clients are customers who have registered on your store.</p>
    </div>
    @endif
</div>
@endsection
