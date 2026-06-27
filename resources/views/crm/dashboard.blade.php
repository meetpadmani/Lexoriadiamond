@extends('crm.layout')
@section('title', 'Dashboard')

@section('content')
<div class="animate-in">
    <!-- Welcome Banner -->
    <div class="crm-card" style="background:linear-gradient(135deg, rgba(99,102,241,0.08), rgba(197,160,89,0.05)); border-color:rgba(99,102,241,0.15); margin-bottom:28px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 style="font-weight:700; margin-bottom:4px;">Welcome back, {{ Auth::user()->name ?? 'Admin' }}! 👋</h4>
                <p style="color:var(--crm-text-dim); margin:0; font-size:0.9rem;">
                    Here's what's happening with your business today, {{ now()->format('l, F j, Y') }}.
                </p>
            </div>
            <a href="{{ route('crm.leads.create') }}" class="crm-btn crm-btn-primary">
                <i class="bi bi-plus-lg"></i> New Lead
            </a>
        </div>
    </div>

    <!-- KPI Stats -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon purple"><i class="bi bi-funnel-fill"></i></div>
                <div class="crm-stat-value">{{ number_format($stats['total_leads']) }}</div>
                <div class="crm-stat-label">Total Leads</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon green"><i class="bi bi-people-fill"></i></div>
                <div class="crm-stat-value">{{ number_format($stats['total_clients']) }}</div>
                <div class="crm-stat-label">Total Clients</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon gold"><i class="bi bi-kanban-fill"></i></div>
                <div class="crm-stat-value">{{ number_format($stats['active_projects']) }}</div>
                <div class="crm-stat-label">Active Projects</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon blue"><i class="bi bi-currency-rupee"></i></div>
                <div class="crm-stat-value">₹{{ number_format($stats['monthly_revenue']) }}</div>
                <div class="crm-stat-label">Monthly Revenue</div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon warning"><i class="bi bi-lightning-fill"></i></div>
                <div class="crm-stat-value">{{ number_format($stats['new_leads_today']) }}</div>
                <div class="crm-stat-label">New Leads Today</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon red"><i class="bi bi-hourglass-split"></i></div>
                <div class="crm-stat-value">₹{{ number_format($stats['pending_payments']) }}</div>
                <div class="crm-stat-label">Pending Payments</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon purple"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div class="crm-stat-value">{{ number_format($stats['total_quotations']) }}</div>
                <div class="crm-stat-label">Total Quotations</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="crm-stat-card">
                <div class="crm-stat-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="crm-stat-value">{{ $stats['conversion_rate'] }}%</div>
                <div class="crm-stat-label">Conversion Rate</div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-lg-7">
            <div class="crm-card">
                <div class="crm-card-header">
                    <h5><i class="bi bi-graph-up me-2" style="color:var(--crm-primary);"></i>Revenue Overview</h5>
                    <span class="crm-badge primary">Last 6 Months</span>
                </div>
                <div style="position:relative; height:240px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="crm-card">
                <div class="crm-card-header">
                    <h5><i class="bi bi-funnel me-2" style="color:var(--crm-gold);"></i>Lead Trend</h5>
                    <span class="crm-badge gold">Last 6 Months</span>
                </div>
                <div style="position:relative; height:240px;">
                    <canvas id="leadChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="crm-card mb-4">
        <div class="crm-card-header">
            <h5><i class="bi bi-lightning-charge-fill me-2" style="color:var(--crm-warning);"></i>Quick Actions</h5>
        </div>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <a href="{{ route('crm.leads.create') }}" class="d-block text-center text-decoration-none crm-card" style="padding:20px; border-color:transparent;">
                    <div class="crm-stat-icon purple mx-auto mb-2" style="width:48px;height:48px;"><i class="bi bi-person-plus-fill"></i></div>
                    <div style="color:var(--crm-text);font-size:0.85rem;font-weight:500;">New Lead</div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('crm.clients.create') }}" class="d-block text-center text-decoration-none crm-card" style="padding:20px; border-color:transparent;">
                    <div class="crm-stat-icon green mx-auto mb-2" style="width:48px;height:48px;"><i class="bi bi-building"></i></div>
                    <div style="color:var(--crm-text);font-size:0.85rem;font-weight:500;">New Client</div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('crm.projects.create') }}" class="d-block text-center text-decoration-none crm-card" style="padding:20px; border-color:transparent;">
                    <div class="crm-stat-icon gold mx-auto mb-2" style="width:48px;height:48px;"><i class="bi bi-gem"></i></div>
                    <div style="color:var(--crm-text);font-size:0.85rem;font-weight:500;">New Project</div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('crm.quotations.create') }}" class="d-block text-center text-decoration-none crm-card" style="padding:20px; border-color:transparent;">
                    <div class="crm-stat-icon blue mx-auto mb-2" style="width:48px;height:48px;"><i class="bi bi-file-earmark-plus"></i></div>
                    <div style="color:var(--crm-text);font-size:0.85rem;font-weight:500;">New Quotation</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const gradient = revenueCtx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.15)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.01)');

    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChartLabels) !!},
            datasets: [{
                label: 'Revenue (₹)',
                data: {!! json_encode($revenueChartData) !!},
                borderColor: '#6366f1',
                backgroundColor: gradient,
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    borderColor: '#e2e8f0',
                    borderWidth: 1,
                    titleColor: '#0f172a',
                    bodyColor: '#64748b',
                    padding: 12,
                    cornerRadius: 10,
                    boxShadow: '0 4px 20px rgba(0,0,0,0.08)',
                    callbacks: {
                        label: function(context) {
                            return ' ₹' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 11 } },
                    border: { display: false }
                },
                y: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: {
                        color: '#94a3b8', font: { size: 11 },
                        callback: function(value) { return '₹' + (value/1000) + 'K'; }
                    },
                    border: { display: false }
                }
            }
        }
    });

    // Lead Chart
    const leadCtx = document.getElementById('leadChart').getContext('2d');

    new Chart(leadCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($leadChartLabels) !!},
            datasets: [{
                label: 'Leads',
                data: {!! json_encode($leadChartData) !!},
                backgroundColor: 'rgba(99, 102, 241, 0.15)',
                borderColor: '#6366f1',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 36,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    borderColor: '#e2e8f0',
                    borderWidth: 1,
                    titleColor: '#0f172a',
                    bodyColor: '#64748b',
                    padding: 12,
                    cornerRadius: 10,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 11 } },
                    border: { display: false }
                },
                y: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 11 }, stepSize: 1 },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endsection
