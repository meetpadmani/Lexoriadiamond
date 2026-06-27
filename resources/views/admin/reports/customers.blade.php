@extends('admin.layout')

@section('title', 'Customer Insights Report')

@section('content')
<div class="content-body animate-fade-in">
    <div class="page-title-box mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4>Customer Insights</h4>
                <div class="breadcrumb-text">Identify your most valuable patrons and their spending patterns</div>
            </div>
            <div>
                <a href="{{ route('admin.reports.index') }}" class="btn btn btn-outline-secondary btn-sm me-2">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Filters & Export -->
    <div class="card mb-4 border-0 shadow-sm" style="overflow: visible;">
        <div class="card-body">
            <form action="{{ route('admin.reports.customers') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Joined From</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Joined To</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn btn-primary w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-download"></i> Export Report
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'pdf', 'report_type' => 'customers'])) }}"><i class="bi bi-file-pdf text-danger me-2"></i>PDF Document</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'excel', 'report_type' => 'customers'])) }}"><i class="bi bi-file-earmark-excel text-success me-2"></i>Excel Spreadsheet</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'csv', 'report_type' => 'customers'])) }}"><i class="bi bi-file-earmark-text text-primary me-2"></i>CSV File</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Email</th>
                        <th class="text-center">Total Orders</th>
                        <th class="text-end pe-4">Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-soft-gold text-gold rounded-circle d-flex align-items-center justify-content-center fw-bold">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $customer->name }}</div>
                                    <div class="small text-secondary">Joined: {{ $customer->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border">{{ $customer->total_orders ?? 0 }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <span class="fw-bold text-dark">${{ number_format($customer->total_spent ?? 0, 2) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-secondary mb-2"><i class="bi bi-people fs-1"></i></div>
                            <h6>No customer data found.</h6>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            {{ $customers->appends(request()->all())->links() }}
        </div>
    </div>
</div>


@endsection
