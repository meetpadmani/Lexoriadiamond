@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    /* Clean Simple Dashboard Styles */
    .stat-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-md);
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .stat-icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: var(--brand-primary);
        font-size: 1.5rem;
        border-radius: var(--radius-sm);
    }

    .dashboard-header-title {
        font-weight: 600;
        color: var(--text-primary);
    }

    .chart-container {
        padding: 20px;
        position: relative;
    }

    .top-product-item {
        padding: 12px 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .top-product-item:last-child {
        border-bottom: none;
    }
    
    .store-tip-box {
        background: #e9ecef;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
    }
</style>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="dashboard-header-title mb-1">Business Overview</h4>
            <p class="text-muted small mb-0">Summary of your store's performance</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <button class="btn-premium">
                <i class="bi bi-cloud-download me-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Stat Grid -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted fw-bold mb-2 stat-title">Total Revenue</div>
                        <h3 class="fw-bold mb-0 stat-value text-dark">${{ number_format($stats['total_sales'], 2) }}</h3>
                    </div>
                    <div class="stat-icon-box" style="background: #e2e3e5; color: #198754;">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top small">
                    <span class="text-success fw-bold"><i class="bi bi-arrow-up-short"></i> ${{ number_format($stats['monthly_earnings']) }}</span>
                    <span class="text-muted ms-1">this month</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted fw-bold mb-2 stat-title">Total Orders</div>
                        <h3 class="fw-bold mb-0 stat-value text-dark">{{ number_format($stats['total_orders']) }}</h3>
                    </div>
                    <div class="stat-icon-box" style="background: #fff3cd; color: #ffc107;">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top small">
                    <span class="badge badge-warning me-1">{{ $stats['pending_orders'] }}</span> <span class="text-muted">Pending</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted fw-bold mb-2 stat-title">Total Customers</div>
                        <h3 class="fw-bold mb-0 stat-value text-dark">{{ number_format($stats['total_customers']) }}</h3>
                    </div>
                    <div class="stat-icon-box" style="background: #cff4fc; color: #0dcaf0;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top small text-muted">
                    Total registered users
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted fw-bold mb-2 stat-title">Total Products</div>
                        <h3 class="fw-bold mb-0 stat-value text-dark">{{ number_format($stats['total_products']) }}</h3>
                    </div>
                    <div class="stat-icon-box" style="background: #e2e3e5; color: #6c757d;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top small text-muted">
                    Active inventory items
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Inquiries Overview -->
    <div class="row g-3 mb-4">
        <div class="col-md-12">
            <h5 class="dashboard-header-title mb-3" style="font-size: 1.1rem;">Custom Inquiries Overview</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="stat-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="small text-muted fw-bold mb-2 stat-title">Total Inquiries</div>
                                <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['total'] }}</h3>
                            </div>
                            <div class="stat-icon-box" style="background: #cfe2ff; color: #0d6efd;">
                                <i class="bi bi-clipboard-data"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="small text-muted fw-bold mb-2 stat-title">Pending</div>
                                <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['pending'] }}</h3>
                            </div>
                            <div class="stat-icon-box" style="background: #fff3cd; color: #ffc107;">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="small text-muted fw-bold mb-2 stat-title">Completed / Accepted</div>
                                <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['completed'] + $customOrderStats['accepted'] }}</h3>
                            </div>
                            <div class="stat-icon-box" style="background: #d1e7dd; color: #198754;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="small text-muted fw-bold mb-2 stat-title">Cancelled / Rejected</div>
                                <h3 class="fw-bold mb-0 stat-value text-dark">{{ $customOrderStats['rejected'] }}</h3>
                            </div>
                            <div class="stat-icon-box" style="background: #f8d7da; color: #dc3545;">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card h-100 mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Revenue Analytics</h5>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>This Year</option>
                        <option>This Month</option>
                    </select>
                </div>
                <div class="card-body chart-container">
                    <canvas id="revenueChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="mb-0">Customer Acquisition</h5>
                </div>
                <div class="card-body chart-container">
                    <canvas id="customerChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="row g-3">
        <!-- Recent Orders -->
        <div class="col-md-8">
            <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-gold-outline">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-bold">#{{ $order->order_number }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="fw-bold">{{ $order->first_name }} {{ $order->last_name }}</div>
                                            <div class="text-muted small">{{ $order->email }}</div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @php
                                            $bg = $order->status == 'delivered' ? 'badge-success' : ($order->status == 'pending' ? 'badge-warning' : ($order->status == 'cancelled' ? 'badge-danger' : 'badge-info'));
                                        @endphp
                                        <span class="badge {{ $bg }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="col-md-4">
            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="mb-0">Top Products</h5>
                </div>
                <div class="card-body p-0">
                    @foreach($topProducts as $product)
                    <div class="top-product-item d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold">{{ Str::limit($product->product_name, 25) }}</div>
                            <div class="text-muted small">{{ $product->total_qty }} Sold</div>
                        </div>
                        <div class="text-end fw-bold">
                            ${{ number_format($product->total_revenue) }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Standard Theme colors for charts
    const primaryColor = '#0d6efd';
    const secondaryColor = '#198754';
    const gridColor = '#e9ecef';
    const textColor = '#6c757d';

    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($salesData) !!},
                borderColor: primaryColor,
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.1, // Less curved, more standard
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: primaryColor,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { color: textColor }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: textColor }
                }
            }
        }
    });

    const ctxCustomer = document.getElementById('customerChart').getContext('2d');
    
    new Chart(ctxCustomer, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'New Customers',
                data: {!! json_encode($customerData) !!},
                backgroundColor: secondaryColor,
                borderRadius: 2,
                barThickness: 16
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { stepSize: 1, color: textColor }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: textColor }
                }
            }
        }
    });
</script>
@endsection
