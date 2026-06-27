@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-dark font-weight-bold">Comparison Dashboard</h2>
        <div>
            <a href="{{ url('admin/competitors') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left"></i> Back</a>
            <button onclick="window.print()" class="btn btn-danger"><i class="bi bi-file-pdf"></i> Download PDF</button>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="table-responsive">
            <table class="table table-hover table-borderless mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 px-4">Brand</th>
                        <th class="py-3 px-4">Price Range</th>
                        <th class="py-3 px-4">Rating</th>
                        <th class="py-3 px-4">IG Followers</th>
                        <th class="py-3 px-4">Active Sale</th>
                        <th class="py-3 px-4">Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lexoria Diamond (Own Brand) -->
                    <tr class="table-warning fw-bold">
                        <td class="py-3 px-4">Lexoria Diamond (Our Brand)</td>
                        <td class="py-3 px-4">$1,500 - $50,000</td>
                        <td class="py-3 px-4"><i class="bi bi-star-fill text-warning"></i> 4.9</td>
                        <td class="py-3 px-4">25,000</td>
                        <td class="py-3 px-4 text-success">Yes</td>
                        <td class="py-3 px-4 text-muted">Just now</td>
                    </tr>

                    @foreach($competitors as $comp)
                    <tr>
                        <td class="py-3 px-4">{{ $comp->name }}</td>
                        <td class="py-3 px-4">
                            ${{ $comp->latestPrice->min_price ?? 0 }} - ${{ $comp->latestPrice->max_price ?? 0 }}
                        </td>
                        <td class="py-3 px-4"><i class="bi bi-star-fill text-warning"></i> {{ $comp->latestStat->avg_rating ?? 'N/A' }}</td>
                        <td class="py-3 px-4">{{ number_format($comp->latestStat->ig_followers ?? 0) }}</td>
                        <td class="py-3 px-4">
                            @if($comp->latestPrice && $comp->latestPrice->active_sale)
                                <span class="badge bg-danger">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-muted small">
                            {{ $comp->latestStat ? $comp->latestStat->last_scraped_at->diffForHumans() : 'Never' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4 text-center">Instagram Followers Comparison</h5>
                    <canvas id="igChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4 text-center">Minimum Price Comparison</h5>
                    <canvas id="priceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = ['Lexoria', ...{!! json_encode($competitors->pluck('name')) !!}];
    const igData = [25000, ...{!! json_encode($competitors->map(fn($c) => $c->latestStat->ig_followers ?? 0)) !!}];
    const priceData = [1500, ...{!! json_encode($competitors->map(fn($c) => $c->latestPrice->min_price ?? 0)) !!}];

    new Chart(document.getElementById('igChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Followers',
                data: igData,
                backgroundColor: ['#C9A96E', ...Array({{ count($competitors) }}).fill('#343a40')]
            }]
        }
    });

    new Chart(document.getElementById('priceChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Min Price ($)',
                data: priceData,
                borderColor: '#dc3545',
                tension: 0.1
            }]
        }
    });
</script>
@endsection
