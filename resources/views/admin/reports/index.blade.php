@extends('admin.layout')

@section('title', 'Analytics & Reports')

@section('styles')
<style>
    /* Premium Core Styling */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Stats Cards Premium */
    .stat-card-premium {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .stat-card-premium::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8) 100%);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.3s ease;
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .stat-card-premium:hover::after {
        opacity: 1;
    }

    /* Animated Icon Backgrounds */
    .icon-bg-glow {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    .icon-bg-glow::before {
        content: ''; position: absolute;
        width: 100%; height: 100%;
        border-radius: 16px;
        background: inherit;
        filter: blur(10px);
        opacity: 0.4;
        z-index: -1;
    }

    /* Report Module Cards */
    .module-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }
    .module-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: rgba(13, 110, 253, 0.1);
    }
    .module-icon-wrapper {
        width: 80px; height: 80px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
        transition: transform 0.4s ease;
    }
    .module-card:hover .module-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }
    
    .btn-view-report {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-radius: 12px;
        padding: 10px 24px;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    .module-card:hover .btn-view-report {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    /* Staggered Animation */
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

    <!-- Header Area -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex align-items-center gap-4">
            <div class="bg-primary bg-opacity-10 p-4 rounded-4 text-primary">
                <i class="bi bi-pie-chart-fill" style="font-size: 2.5rem;"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.5px;">Analytics & Reports</h2>
                <p class="text-secondary mb-0 fs-6">Comprehensive insights into your store's financial performance and customer behavior.</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6 fade-in-up" style="animation-delay: 0.1s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #0d6efd;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Revenue</div>
                        <h2 class="mb-0 fw-bolder text-dark">${{ number_format($stats['total_sales'], 2) }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 fade-in-up" style="animation-delay: 0.2s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #198754;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Profit</div>
                        <h2 class="mb-0 fw-bolder text-dark">${{ number_format($stats['total_profit'], 2) }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-success bg-opacity-10 text-success">
                        <i class="bi bi-graph-up-arrow fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 fade-in-up" style="animation-delay: 0.3s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #0dcaf0;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Tax Collected</div>
                        <h2 class="mb-0 fw-bolder text-dark">${{ number_format($stats['total_tax'], 2) }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-info bg-opacity-10 text-info">
                        <i class="bi bi-receipt-cutoff fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 fade-in-up" style="animation-delay: 0.4s;">
            <div class="stat-card-premium p-4 h-100" style="border-bottom: 4px solid #6f42c1;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Customers</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ number_format($stats['total_customers']) }}</h2>
                    </div>
                    <div class="icon-bg-glow" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modules -->
    <div class="row g-4">
        
        <!-- Sales Report Card -->
        <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.5s;">
            <div class="module-card p-5 text-center h-100 d-flex flex-column">
                <div class="module-icon-wrapper bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-cart-check-fill fs-1"></i>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Sales Reports</h4>
                <p class="text-secondary mb-4 flex-grow-1" style="font-size: 0.95rem;">Comprehensive breakdown of all orders, revenue streams, and detailed transaction trends over time.</p>
                <a href="{{ route('admin.reports.sales') }}" class="btn btn-view-report w-100">Access Report</a>
            </div>
        </div>

        <!-- Product Performance Card -->
        <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.6s;">
            <div class="module-card p-5 text-center h-100 d-flex flex-column">
                <div class="module-icon-wrapper bg-success bg-opacity-10 text-success">
                    <i class="bi bi-bag-heart-fill fs-1"></i>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Product Analytics</h4>
                <p class="text-secondary mb-4 flex-grow-1" style="font-size: 0.95rem;">Analyze best-selling items, underperforming categories, and detailed inventory movement metrics.</p>
                <a href="{{ route('admin.reports.products') }}" class="btn btn-view-report w-100">Access Report</a>
            </div>
        </div>

        <!-- Customer Insights Card -->
        <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.7s;">
            <div class="module-card p-5 text-center h-100 d-flex flex-column">
                <div class="module-icon-wrapper" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                    <i class="bi bi-person-hearts fs-1"></i>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Customer Insights</h4>
                <p class="text-secondary mb-4 flex-grow-1" style="font-size: 0.95rem;">Deep dive into customer spending habits, lifetime value, loyalty metrics, and demographics.</p>
                <a href="{{ route('admin.reports.customers') }}" class="btn btn-view-report w-100">Access Report</a>
            </div>
        </div>

        <!-- Tax Compliance Card -->
        <div class="col-lg-6 fade-in-up" style="animation-delay: 0.8s;">
            <div class="module-card p-4 d-flex align-items-center gap-4 h-100">
                <div class="module-icon-wrapper bg-info bg-opacity-10 text-info flex-shrink-0 mb-0 mx-0">
                    <i class="bi bi-file-earmark-ruled-fill fs-2"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-2 text-dark">Tax & Compliance Reports</h4>
                    <p class="text-secondary mb-3" style="font-size: 0.95rem;">Review GST and other tax collections for financial reconciliation and automated filing preparation.</p>
                    <a href="{{ route('admin.reports.tax') }}" class="btn btn-view-report d-inline-block px-4">Access Report</a>
                </div>
            </div>
        </div>

        <!-- Profit & Loss Card -->
        <div class="col-lg-6 fade-in-up" style="animation-delay: 0.9s;">
            <div class="module-card p-4 d-flex align-items-center gap-4 h-100">
                <div class="module-icon-wrapper bg-danger bg-opacity-10 text-danger flex-shrink-0 mb-0 mx-0">
                    <i class="bi bi-calculator-fill fs-2"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-2 text-dark">Profit & Loss Analysis</h4>
                    <p class="text-secondary mb-3" style="font-size: 0.95rem;">Calculate accurate margins by comparing exact product procurement costs against final selling prices.</p>
                    <a href="{{ route('admin.reports.profit_loss') }}" class="btn btn-view-report d-inline-block px-4">Access Report</a>
                </div>
            </div>
        </div>

    </div>

@endsection
