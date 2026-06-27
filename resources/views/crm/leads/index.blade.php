@extends('crm.layout')
@section('title', 'Leads Management')

@section('content')
<div class="animate-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="font-weight: 700;">Leads</h2>
            <p class="text-muted mb-0">Manage and track all your potential clients and customized design requests.</p>
        </div>
        <div>
            <a href="{{ route('crm.leads.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Lead
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="crm-card">
        <div class="table-responsive">
            <table class="table crm-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $lead->status ?? 'New' }}</span>
                        </td>
                        <td>{{ $lead->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('crm.leads.show', $lead->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No leads found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $leads->links() }}
        </div>
    </div>
</div>
@endsection
