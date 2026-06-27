<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lexoria CRM - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            /* Dark Theme */
            --crm-bg: #0f1117;
            --crm-surface: #1a1d27;
            --crm-surface-hover: #22263a;
            --crm-surface-active: #2a2e42;
            --crm-border: #2d3148;
            --crm-border-light: #383d56;

            /* Accent */
            --crm-primary: #6366f1;
            --crm-primary-hover: #818cf8;
            --crm-primary-light: rgba(99, 102, 241, 0.12);
            --crm-primary-glow: rgba(99, 102, 241, 0.25);

            /* Status Colors */
            --crm-success: #22c55e;
            --crm-warning: #f59e0b;
            --crm-danger: #ef4444;
            --crm-info: #3b82f6;

            /* Text */
            --crm-text: #e2e8f0;
            --crm-text-muted: #94a3b8;
            --crm-text-dim: #64748b;

            /* Gold Accent (matches Lexoria brand) */
            --crm-gold: #c5a059;
            --crm-gold-light: rgba(197, 160, 89, 0.12);

            /* Layout */
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --topbar-height: 64px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--crm-bg);
            color: var(--crm-text);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--crm-border); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--crm-border-light); }

        /* ==================== SIDEBAR ==================== */
        .crm-sidebar {
            position: fixed;
            left: 0; top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--crm-surface);
            border-right: 1px solid var(--crm-border);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .crm-sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid var(--crm-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .crm-sidebar-brand .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--crm-primary), var(--crm-gold));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            font-weight: 700;
            flex-shrink: 0;
        }

        .crm-sidebar-brand .brand-text {
            display: flex;
            flex-direction: column;
        }

        .crm-sidebar-brand .brand-text h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--crm-text);
            margin: 0;
            letter-spacing: 0.5px;
        }

        .crm-sidebar-brand .brand-text span {
            font-size: 0.7rem;
            color: var(--crm-primary);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        /* Sidebar Nav */
        .crm-sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 12px 0;
        }

        .nav-section-label {
            padding: 16px 24px 8px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--crm-text-dim);
            font-weight: 600;
        }

        .crm-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
            color: var(--crm-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin: 2px 8px;
            border-radius: 8px;
            position: relative;
        }

        .crm-nav-item:hover {
            color: var(--crm-text);
            background: var(--crm-surface-hover);
        }

        .crm-nav-item.active {
            color: var(--crm-primary);
            background: var(--crm-primary-light);
        }

        .crm-nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 20px;
            background: var(--crm-primary);
            border-radius: 0 4px 4px 0;
        }

        .crm-nav-item i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }

        .crm-nav-badge {
            margin-left: auto;
            background: var(--crm-primary);
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .crm-nav-badge.warning { background: var(--crm-warning); }
        .crm-nav-badge.danger { background: var(--crm-danger); }

        /* Sidebar Footer */
        .crm-sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--crm-border);
        }

        .crm-user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: var(--crm-surface-hover);
            border-radius: 10px;
        }

        .crm-user-avatar {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--crm-primary), #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            flex-shrink: 0;
        }

        .crm-user-info {
            flex: 1;
            min-width: 0;
        }

        .crm-user-info h6 {
            font-size: 0.8rem;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--crm-text);
        }

        .crm-user-info span {
            font-size: 0.7rem;
            color: var(--crm-text-dim);
            text-transform: capitalize;
        }

        /* ==================== TOPBAR ==================== */
        .crm-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: var(--crm-surface);
            border-bottom: 1px solid var(--crm-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 999;
            transition: left 0.3s ease;
        }

        .crm-topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .crm-topbar-left h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .crm-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: var(--crm-text-dim);
        }

        .crm-breadcrumb a {
            color: var(--crm-text-muted);
            text-decoration: none;
        }

        .crm-breadcrumb a:hover { color: var(--crm-primary); }

        .crm-topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .crm-topbar-btn {
            width: 40px; height: 40px;
            border-radius: 10px;
            border: 1px solid var(--crm-border);
            background: transparent;
            color: var(--crm-text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .crm-topbar-btn:hover {
            background: var(--crm-surface-hover);
            color: var(--crm-text);
        }

        .crm-topbar-btn .badge-dot {
            position: absolute;
            top: 8px; right: 8px;
            width: 8px; height: 8px;
            background: var(--crm-danger);
            border-radius: 50%;
            border: 2px solid var(--crm-surface);
        }

        .crm-mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--crm-text);
            font-size: 1.3rem;
            cursor: pointer;
        }

        /* ==================== MAIN CONTENT ==================== */
        .crm-main {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 28px;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
        }

        /* ==================== CARDS ==================== */
        .crm-card {
            background: var(--crm-surface);
            border: 1px solid var(--crm-border);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.2s;
        }

        .crm-card:hover {
            border-color: var(--crm-border-light);
        }

        .crm-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .crm-card-header h5 {
            font-size: 0.95rem;
            font-weight: 600;
            margin: 0;
        }

        /* Stat Cards */
        .crm-stat-card {
            background: var(--crm-surface);
            border: 1px solid var(--crm-border);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .crm-stat-card:hover {
            border-color: var(--crm-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .crm-stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 16px;
        }

        .crm-stat-icon.purple { background: rgba(99, 102, 241, 0.12); color: var(--crm-primary); }
        .crm-stat-icon.green { background: rgba(34, 197, 94, 0.12); color: var(--crm-success); }
        .crm-stat-icon.gold { background: var(--crm-gold-light); color: var(--crm-gold); }
        .crm-stat-icon.blue { background: rgba(59, 130, 246, 0.12); color: var(--crm-info); }
        .crm-stat-icon.red { background: rgba(239, 68, 68, 0.12); color: var(--crm-danger); }
        .crm-stat-icon.warning { background: rgba(245, 158, 11, 0.12); color: var(--crm-warning); }

        .crm-stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--crm-text);
            margin-bottom: 4px;
        }

        .crm-stat-label {
            font-size: 0.8rem;
            color: var(--crm-text-dim);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ==================== TABLES ==================== */
        .crm-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .crm-table thead th {
            background: var(--crm-surface-hover);
            padding: 12px 16px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--crm-text-dim);
            font-weight: 600;
            border-bottom: 1px solid var(--crm-border);
        }

        .crm-table thead th:first-child { border-radius: 8px 0 0 0; }
        .crm-table thead th:last-child { border-radius: 0 8px 0 0; }

        .crm-table tbody td {
            padding: 14px 16px;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--crm-border);
            color: var(--crm-text-muted);
        }

        .crm-table tbody tr:hover td {
            background: var(--crm-surface-hover);
        }

        .crm-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ==================== BADGES ==================== */
        .crm-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .crm-badge.success { background: rgba(34, 197, 94, 0.12); color: var(--crm-success); }
        .crm-badge.warning { background: rgba(245, 158, 11, 0.12); color: var(--crm-warning); }
        .crm-badge.danger { background: rgba(239, 68, 68, 0.12); color: var(--crm-danger); }
        .crm-badge.info { background: rgba(59, 130, 246, 0.12); color: var(--crm-info); }
        .crm-badge.primary { background: var(--crm-primary-light); color: var(--crm-primary); }
        .crm-badge.gold { background: var(--crm-gold-light); color: var(--crm-gold); }

        /* ==================== BUTTONS ==================== */
        .crm-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .crm-btn-primary {
            background: var(--crm-primary);
            color: white;
        }

        .crm-btn-primary:hover {
            background: var(--crm-primary-hover);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px var(--crm-primary-glow);
        }

        .crm-btn-outline {
            background: transparent;
            border: 1px solid var(--crm-border);
            color: var(--crm-text-muted);
        }

        .crm-btn-outline:hover {
            background: var(--crm-surface-hover);
            border-color: var(--crm-border-light);
            color: var(--crm-text);
        }

        .crm-btn-danger {
            background: rgba(239, 68, 68, 0.12);
            color: var(--crm-danger);
        }

        .crm-btn-danger:hover {
            background: var(--crm-danger);
            color: white;
        }

        .crm-btn-sm {
            padding: 6px 14px;
            font-size: 0.8rem;
        }

        /* ==================== FORMS ==================== */
        .crm-form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--crm-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }

        .crm-form-control {
            width: 100%;
            padding: 10px 14px;
            background: var(--crm-bg);
            border: 1px solid var(--crm-border);
            border-radius: 8px;
            color: var(--crm-text);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .crm-form-control:focus {
            outline: none;
            border-color: var(--crm-primary);
            box-shadow: 0 0 0 3px var(--crm-primary-light);
        }

        .crm-form-control::placeholder {
            color: var(--crm-text-dim);
        }

        .crm-form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 36px;
        }

        /* ==================== RESPONSIVE ==================== */
        .crm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        @media (max-width: 992px) {
            .crm-sidebar {
                transform: translateX(-100%);
            }

            .crm-sidebar.open {
                transform: translateX(0);
            }

            .crm-topbar {
                left: 0;
            }

            .crm-main {
                margin-left: 0;
            }

            .crm-mobile-toggle {
                display: block;
            }

            .crm-overlay.show {
                display: block;
            }
        }

        /* ==================== ANIMATIONS ==================== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeIn 0.4s ease forwards;
        }

        /* ==================== PAGE SPECIFIC OVERRIDES ==================== */
        @yield('styles')
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="crm-sidebar" id="crmSidebar">
        <div class="crm-sidebar-brand">
            <div class="logo-icon"><i class="bi bi-gem"></i></div>
            <div class="brand-text">
                <h5>LEXORIA</h5>
                <span>CRM Platform</span>
            </div>
        </div>

        <nav class="crm-sidebar-nav">
            <div class="nav-section-label">Main</div>
            <a href="{{ route('crm.dashboard') }}" class="crm-nav-item {{ request()->routeIs('crm.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="nav-section-label">Sales</div>
            <a href="{{ route('crm.leads.index') }}" class="crm-nav-item {{ request()->routeIs('crm.leads.*') ? 'active' : '' }}">
                <i class="bi bi-funnel-fill"></i>
                <span>Leads</span>
                <span class="crm-nav-badge" id="lead-count"></span>
            </a>
            <a href="{{ route('crm.clients.index') }}" class="crm-nav-item {{ request()->routeIs('crm.clients.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Clients</span>
            </a>

            <div class="nav-section-label">Operations</div>
            <a href="{{ route('crm.projects.index') }}" class="crm-nav-item {{ request()->routeIs('crm.projects.*') ? 'active' : '' }}">
                <i class="bi bi-kanban-fill"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('crm.quotations.index') }}" class="crm-nav-item {{ request()->routeIs('crm.quotations.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Quotations</span>
            </a>
            <a href="{{ route('crm.invoices.index') }}" class="crm-nav-item {{ request()->routeIs('crm.invoices.*') ? 'active' : '' }}">
                <i class="bi bi-receipt-cutoff"></i>
                <span>Invoices</span>
            </a>
            <a href="{{ route('crm.payments.index') }}" class="crm-nav-item {{ request()->routeIs('crm.payments.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-2-front-fill"></i>
                <span>Payments</span>
            </a>

            <div class="nav-section-label">Tools</div>
            <a href="{{ route('crm.files.index') }}" class="crm-nav-item {{ request()->routeIs('crm.files.*') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                <span>File Manager</span>
            </a>
            <a href="{{ route('crm.whatsapp.index') }}" class="crm-nav-item {{ request()->routeIs('crm.whatsapp.*') ? 'active' : '' }}">
                <i class="bi bi-whatsapp"></i>
                <span>WhatsApp</span>
                <span class="crm-nav-badge warning" id="wa-count"></span>
            </a>
            <a href="{{ route('crm.notifications.index') }}" class="crm-nav-item {{ request()->routeIs('crm.notifications.*') ? 'active' : '' }}">
                <i class="bi bi-bell-fill"></i>
                <span>Notifications</span>
            </a>

            <div class="nav-section-label">Admin</div>
            <a href="{{ route('admin.dashboard') }}" class="crm-nav-item">
                <i class="bi bi-arrow-left-square"></i>
                <span>Back to Admin</span>
            </a>
        </nav>

        <div class="crm-sidebar-footer">
            <div class="crm-user-card">
                <div class="crm-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="crm-user-info">
                    <h6>{{ Auth::user()->name ?? 'User' }}</h6>
                    <span>{{ Auth::user()->crm_role ?? Auth::user()->role ?? 'Admin' }}</span>
                </div>
                <form action="{{ route('crm.logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:var(--crm-text-dim);cursor:pointer;" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay (mobile) -->
    <div class="crm-overlay" id="crmOverlay"></div>

    <!-- Topbar -->
    <header class="crm-topbar">
        <div class="crm-topbar-left">
            <button class="crm-mobile-toggle" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <h4>@yield('title', 'Dashboard')</h4>
                <div class="crm-breadcrumb">
                    <a href="{{ route('crm.dashboard') }}">CRM</a>
                    <i class="bi bi-chevron-right" style="font-size:0.6rem;"></i>
                    <span>@yield('title', 'Dashboard')</span>
                </div>
            </div>
        </div>

        <div class="crm-topbar-right">
            <div class="crm-topbar-btn" title="Search" style="cursor:pointer;">
                <i class="bi bi-search"></i>
            </div>
            <a href="{{ route('crm.notifications.index') }}" class="crm-topbar-btn" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="badge-dot" id="notif-dot" style="display:none;"></span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="crm-topbar-btn" title="Admin Panel">
                <i class="bi bi-gear"></i>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="crm-main">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);color:var(--crm-success);border-radius:10px;padding:14px 20px;margin-bottom:20px;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="font-size:0.7rem;filter:invert(53%) sepia(82%) saturate(422%) hue-rotate(87deg) brightness(96%) contrast(95%);"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:var(--crm-danger);border-radius:10px;padding:14px 20px;margin-bottom:20px;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="font-size:0.7rem;filter:invert(35%) sepia(82%) saturate(1820%) hue-rotate(342deg) brightness(96%) contrast(92%);"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:var(--crm-danger);border-radius:10px;padding:14px 20px;margin-bottom:20px;">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Please fix the following:</strong>
                </div>
                <ul style="margin:0;padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile sidebar toggle
        const sidebar = document.getElementById('crmSidebar');
        const overlay = document.getElementById('crmOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            });
        }

        // CSRF token for AJAX
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    </script>

    @yield('scripts')
</body>
</html>
