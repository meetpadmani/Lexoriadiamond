@extends('admin.layout')

@section('title', 'Tax Compliance Report')

@section('content')
<div class="content-body animate-fade-in">
    <div class="page-title-box mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4>Tax Compliance</h4>
                <div class="breadcrumb-text">Detailed breakdown of tax collections for filing and reconciliation</div>
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
            <form action="{{ route('admin.reports.tax') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">From Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">To Date</label>
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
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'pdf', 'report_type' => 'tax'])) }}"><i class="bi bi-file-pdf text-danger me-2"></i>PDF Document</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'excel', 'report_type' => 'tax'])) }}"><i class="bi bi-file-earmark-excel text-success me-2"></i>Excel Spreadsheet</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reports.export', array_merge(request()->all(), ['type' => 'csv', 'report_type' => 'tax'])) }}"><i class="bi bi-file-earmark-text text-primary me-2"></i>CSV File</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body p-4">
                    <div class="small opacity-75 text-uppercase fw-bold mb-1">Total Tax Collected</div>
                    <h2 class="mb-0 fw-bold">${{ number_format($totalTax, 2) }}</h2>
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
                        <th>Total Amount</th>
                        <th class="text-end pe-4">Tax Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-medium">{{ $order->created_at->format('M d, Y') }}</div>
                        </td>
                        <td><span class="fw-bold text-dark">{{ $order->order_number }}</span></td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td class="text-end pe-4">
                            <span class="fw-bold text-info">${{ number_format($order->tax_amount, 2) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-secondary mb-2"><i class="bi bi-file-earmark-ruled fs-1"></i></div>
                            <h6>No tax collection data found.</h6>
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
