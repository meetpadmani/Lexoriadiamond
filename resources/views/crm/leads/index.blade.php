@extends('crm.layout')
@section('title', 'Leads Management')

@section('content')
<div class="animate-in">
    <div class="crm-page-header">
        <div>
            <h2 class="crm-page-title">Leads</h2>
            <p class="crm-page-subtitle">Manage and track all your potential clients and design requests</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('crm.leads.kanban') }}" class="crm-btn crm-btn-outline">
                <i class="bi bi-kanban"></i> Kanban View
            </a>
            <a href="{{ route('crm.leads.create') }}" class="crm-btn crm-btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Lead
            </a>
        </div>
    </div>

    <div class="crm-card">
        @if($leads->count())
        <div class="table-responsive">
            <table class="crm-table">
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
                    @foreach($leads as $lead)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="crm-avatar-sm">{{ strtoupper(substr($lead->name, 0, 1)) }}</div>
                                <span style="font-weight:500; color:var(--crm-text);">{{ $lead->name }}</span>
                            </div>
                        </td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone ?? '—' }}</td>
                        <td>
                            @php
                                $statusClass = match($lead->status ?? 'new') {
                                    'won' => 'success',
                                    'lost' => 'danger',
                                    'qualified' => 'info',
                                    'proposal' => 'gold',
                                    default => 'primary'
                                };
                            @endphp
                            <span class="crm-badge {{ $statusClass }}">
                                <i class="bi bi-circle-fill" style="font-size:0.45rem;"></i>
                                {{ ucfirst($lead->status ?? 'New') }}
                            </span>
                        </td>
                        <td style="color:var(--crm-text-dim);">{{ $lead->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('crm.leads.show', $lead->id) }}" class="crm-btn crm-btn-sm crm-btn-outline">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $leads->links() }}</div>
        @else
        <div class="crm-empty-state">
            <i class="bi bi-funnel"></i>
            <h5>No Leads Yet</h5>
            <p>Start tracking potential clients by adding your first lead.</p>
            <a href="{{ route('crm.leads.create') }}" class="crm-btn crm-btn-primary mt-3">
                <i class="bi bi-plus-lg"></i> Add Your First Lead
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
