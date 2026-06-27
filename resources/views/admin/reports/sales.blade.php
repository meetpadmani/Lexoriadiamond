@extends('admin.layout')

@section('title', 'Sales Reports')

@section('content')
<div class="content-body animate-fade-in">
    <div class="page-title-box mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4>Sales Reports</h4>
                <div class="breadcrumb-text">Detailed transaction history and revenue tracking</div>
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
            <form action="{{ route('admin.reports.sales') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">End Date</label>
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
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'pdf', 'report_type' => 'sales'])) }}"><i class="bi bi-file-pdf text-danger me-2"></i>PDF Document</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'excel', 'report_type' => 'sales'])) }}"><i class="bi bi-file-earmark-excel text-success me-2"></i>Excel Spreadsheet</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'csv', 'report_type' => 'sales'])) }}"><i class="bi bi-file-earmark-text text-primary me-2"></i>CSV File</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-premium text-white">
                <div class="card-body p-4">
                    <div class="small opacity-75 text-uppercase fw-bold mb-1">Total Revenue (Filtered)</div>
                    <h2 class="mb-0 fw-bold">${{ number_format($totalSales, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="small text-secondary text-uppercase fw-bold mb-1">Total Orders</div>
                    <h2 class="mb-0 fw-bold text-dark">{{ $orders->total() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-medium">{{ $order->created_at->format('M d, Y') }}</div>
                            <div class="small text-secondary">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        <td><span class="fw-bold text-dark">{{ $order->order_number }}</span></td>
                        <td>
                            <div class="fw-medium text-dark">{{ $order->first_name }} {{ $order->last_name }}</div>
                            <div class="small text-secondary">{{ $order->email }}</div>
                        </td>
                        <td><span class="fw-bold text-dark">${{ number_format($order->total_amount, 2) }}</span></td>
                        <td><span class="badge bg-light text-dark border">{{ strtoupper($order->payment_method) }}</span></td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'pending' => 'bg-warning-subtle text-warning',
                                    'processing' => 'bg-info-subtle text-info',
                                    'shipped' => 'bg-primary-subtle text-primary',
                                    'delivered' => 'bg-success-subtle text-success',
                                    'cancelled' => 'bg-danger-subtle text-danger',
                                    default => 'bg-secondary-subtle text-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} px-3 py-2 text-uppercase" style="font-size: 0.65rem;">{{ $order->status }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-secondary mb-2"><i class="bi bi-inbox fs-1"></i></div>
                            <h6>No sales data found for the selected period.</h6>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            {{ $orders->appends(request()->all())->links() }}
        </div>
    </div>
</div>


@endsection
