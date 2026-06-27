@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-dark font-weight-bold">Competitor Intelligence</h2>
        <div>
            <a href="{{ url('admin/competitors/dashboard') }}" class="btn btn-primary"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
            <button onclick="scrapeAll()" class="btn btn-success ms-2"><i class="bi bi-cloud-arrow-down me-1"></i> Scrape Now</button>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">Find Competitors</h5>
            <div class="d-flex gap-3">
                <input type="text" id="searchInput" class="form-control" placeholder="e.g. diamond jewellery online India">
                <button onclick="searchCompetitors()" class="btn btn-dark px-4">Search</button>
            </div>
            <div id="searchResults" class="mt-4 d-none">
                <!-- Search results will be injected here via JS -->
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="?filter=all" class="btn rounded-pill {{ request('filter') == 'all' || !request('filter') ? 'btn-dark' : 'btn-outline-secondary' }}">All</a>
        <a href="?filter=ig_active" class="btn rounded-pill {{ request('filter') == 'ig_active' ? 'btn-dark' : 'btn-outline-secondary' }}">Instagram Active</a>
        <a href="?filter=sale_on" class="btn rounded-pill {{ request('filter') == 'sale_on' ? 'btn-dark' : 'btn-outline-secondary' }}">Active Sale</a>
        <a href="?filter=rating_high" class="btn rounded-pill {{ request('filter') == 'rating_high' ? 'btn-dark' : 'btn-outline-secondary' }}">Rating 4.5+</a>
        <a href="?filter=new" class="btn rounded-pill {{ request('filter') == 'new' ? 'btn-dark' : 'btn-outline-secondary' }}">New (Last 30 Days)</a>
    </div>

    <!-- Competitors List -->
    <div class="row g-4">
        @foreach($competitors as $competitor)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100" style="border-top: 4px solid #343a40 !important;">
                <div class="card-body position-relative">
                    @if($competitor->latestPrice && $competitor->latestPrice->active_sale)
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3 p-2">SALE</span>
                    @endif
                    
                    <h4 class="card-title fw-bold mb-1">{{ $competitor->name }}</h4>
                    <a href="https://{{ $competitor->domain }}" target="_blank" class="text-primary small mb-3 d-block text-decoration-none">{{ $competitor->domain }}</a>
                    
                    <div class="row mb-3 small">
                        <div class="col-6 mb-2">
                            <span class="text-muted d-block">Rating</span>
                            <span class="fw-bold text-dark"><i class="bi bi-star-fill text-warning"></i> {{ $competitor->latestStat->avg_rating ?? 'N/A' }}</span>
                        </div>
                        <div class="col-6 mb-2">
                            <span class="text-muted d-block">IG Followers</span>
                            <span class="fw-bold text-dark">{{ number_format($competitor->latestStat->ig_followers ?? 0) }}</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted d-block">Price Range</span>
                            <span class="fw-bold text-dark">
                                ${{ $competitor->latestPrice->min_price ?? 0 }} - ${{ $competitor->latestPrice->max_price ?? 0 }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="small text-muted">Added: {{ $competitor->added_at->format('d M, Y') }}</span>
                        <button onclick="removeCompetitor({{ $competitor->id }})" class="btn btn-link text-danger p-0 text-decoration-none small">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Alerts Feed -->
    <div class="card shadow-sm border-0 mt-5" style="border-left: 4px solid #ffc107 !important;">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-4">Recent Alerts</h5>
            <div id="alertFeed">
                <!-- Loaded via JS -->
                <p class="text-muted mb-0">Loading alerts...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function searchCompetitors() {
        const keyword = document.getElementById('searchInput').value;
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '<p class="text-muted">Searching...</p>';
        resultsDiv.classList.remove('d-none');

        fetch('{{ url("admin/competitors/search") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ keyword })
        })
        .then(res => res.json())
        .then(data => {
            if(data.error) {
                resultsDiv.innerHTML = `<p class="text-danger">${data.error}</p>`;
                return;
            }
            let html = '<div class="row g-4 mt-1">';
            data.forEach((item, index) => {
                let rankColor = index < 3 ? 'linear-gradient(135deg, #FFD700, #FDB931)' : 'linear-gradient(135deg, #e0e0e0, #bdbdbd)';
                let rankText = index < 3 ? '#000' : '#333';
                let topBorder = index < 3 ? 'border-top: 4px solid #FDB931;' : 'border-top: 4px solid #dee2e6;';
                
                html += `
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm competitor-result-card" style="transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); cursor: default; border-radius: 12px; ${topBorder}">
                        <div class="card-body p-4 d-flex flex-column position-relative overflow-hidden">
                            <!-- Background Accent -->
                            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                                <svg width="60" height="60" fill="currentColor" class="text-secondary" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm2.5 10.5a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5zM5 6.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm6 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0z"/></svg>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-start mb-3 position-relative z-1">
                                <div class="d-flex align-items-center justify-content-center shadow-sm rounded-circle fw-bold" style="width: 36px; height: 36px; font-size: 1.1rem; background: ${rankColor}; color: ${rankText};">
                                    ${index + 1}
                                </div>
                                <span class="badge bg-white text-success border border-success-subtle px-2 py-1 rounded-pill" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                    <i class="bi bi-shield-check me-1"></i>Verified
                                </span>
                            </div>
                            
                            <h5 class="fw-bold text-dark mb-2 position-relative z-1" style="font-size: 1.15rem; line-height: 1.4;">${item.title}</h5>
                            
                            <a href="${item.link}" target="_blank" class="text-primary text-decoration-none small fw-semibold mb-3 d-inline-flex align-items-center gap-1 position-relative z-1" style="color: #0d6efd !important;">
                                <i class="bi bi-link-45deg fs-5"></i>
                                <span class="border-bottom border-primary-subtle pb-1">${item.domain}</span>
                            </a>
                            
                            <p class="text-muted small mb-4 flex-grow-1 position-relative z-1" style="line-height: 1.6; font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                ${item.snippet}
                            </p>
                            
                            <button onclick="trackCompetitor('${item.title.replace(/'/g, "\\'")}', '${item.domain}')" class="btn btn-dark w-100 fw-bold d-flex align-items-center justify-content-center gap-2 track-btn position-relative z-1" style="padding: 12px; border-radius: 8px; transition: all 0.3s ease;">
                                <i class="bi bi-crosshair"></i>
                                Start Tracking
                            </button>
                        </div>
                    </div>
                </div>`;
            });
            html += '</div>';
            resultsDiv.innerHTML = html;
            
            if (!document.getElementById('competitorSearchStyles')) {
                const style = document.createElement('style');
                style.id = 'competitorSearchStyles';
                style.innerHTML = \`
                    .competitor-result-card:hover { 
                        transform: translateY(-8px); 
                        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; 
                    }
                    .track-btn:hover {
                        background: linear-gradient(135deg, #111, #333) !important;
                        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                        transform: scale(1.02);
                    }
                \`;
                document.head.appendChild(style);
            }
        });
    }

    function trackCompetitor(name, domain) {
        fetch('{{ url("admin/competitors/store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name.substring(0, 50), domain })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error processing request');
            }
        });
    }

    function removeCompetitor(id) {
        if(confirm('Are you sure you want to remove this competitor?')) {
            fetch(`{{ url("admin/competitors") }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) location.reload();
            });
        }
    }

    function scrapeAll() {
        fetch('{{ url("admin/competitors/scrape") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => alert(data.message));
    }

    // Load Alerts
    fetch('{{ url("admin/competitors/alerts") }}')
        .then(res => res.json())
        .then(data => {
            const alertFeed = document.getElementById('alertFeed');
            if(data.data.length === 0) {
                alertFeed.innerHTML = '<p class="text-muted mb-0">No new alerts.</p>';
                return;
            }
            let html = '<ul class="list-group list-group-flush">';
            data.data.forEach(alert => {
                let colorClass = alert.is_read ? 'text-muted' : 'text-dark fw-bold';
                let icon = alert.alert_type == 'PRICE_DROP' ? '📉' : (alert.alert_type == 'NEW_SALE' ? '🔥' : '📈');
                html += `
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div class="${colorClass}">
                        <span class="me-2">${icon}</span> ${alert.message} 
                        <span class="small text-muted ms-2">${new Date(alert.created_at).toLocaleString()}</span>
                    </div>
                    ${!alert.is_read ? `<button onclick="markRead(${alert.id})" class="btn btn-link btn-sm text-primary p-0 text-decoration-none">Mark Read</button>` : ''}
                </li>`;
            });
            html += '</ul>';
            alertFeed.innerHTML = html;
        });

    function markRead(id) {
        fetch(`{{ url("admin/competitors/alerts") }}/${id}/read`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => location.reload());
    }
</script>
@endsection
