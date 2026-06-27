@extends('admin.layout')

@section('title', 'Poster Management')

@section('styles')
    <style>
        /* Clean Simple Theme Styles for Posters */
        .poster-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-mini {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .stat-mini-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            background: #f8f9fa;
        }

        .stat-mini-icon.primary { color: #0d6efd; background: #cfe2ff; }
        .stat-mini-icon.success { color: #198754; background: #d1e7dd; }
        .stat-mini-icon.secondary { color: #6c757d; background: #e2e3e5; }

        .stat-mini-text .num {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: var(--text-primary);
        }

        .stat-mini-text .label {
            font-size: 0.85rem;
            margin-top: 5px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Preview Section */
        .preview-card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: var(--bg-card);
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .preview-header {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
        }

        .preview-header .ph-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .preview-header .ph-left i {
            color: var(--brand-primary);
            font-size: 1.2rem;
        }

        .preview-header .ph-left h6 {
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .preview-header .ph-left small {
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .live-dot {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: #198754;
            font-weight: 600;
        }

        .live-dot::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #198754;
            border-radius: 50%;
        }

        /* Poster Preview Carousel */
        .preview-carousel {
            padding: 24px;
            background: #f8f9fa;
        }

        .preview-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            padding-bottom: 12px;
        }

        .preview-slider::-webkit-scrollbar {
            height: 6px;
        }

        .preview-slider::-webkit-scrollbar-track {
            background: #e9ecef;
            border-radius: 10px;
        }

        .preview-slider::-webkit-scrollbar-thumb {
            background: #adb5bd;
            border-radius: 10px;
        }

        .preview-slide {
            flex: 0 0 320px;
            height: 180px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: relative;
            scroll-snap-align: start;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .preview-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px 15px;
        }

        .preview-slide-title {
            color: #fff;
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .preview-empty {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }

        .preview-empty i {
            font-size: 2.5rem;
            color: #dee2e6;
            display: block;
            margin-bottom: 10px;
        }

        /* Poster List Card */
        .poster-list-card {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .poster-list-header {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
        }

        .poster-list-header .plh-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .poster-list-header h6 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-primary);
        }

        /* Table Specific */
        .handle {
            cursor: grab;
            color: #adb5bd;
            font-size: 1.2rem;
            padding: 0 10px;
        }
        
        .handle:hover {
            color: var(--text-primary);
        }

        .handle:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: 0.5;
            background-color: #f8f9fa !important;
        }

        .poster-thumb-wrap {
            position: relative;
            width: 80px;
            height: 45px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
        }

        .poster-thumb-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .poster-name {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-primary);
            display: block;
        }

        .poster-meta {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 2px;
            display: block;
        }

        /* Action Buttons */
        .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border-color);
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-secondary);
            border-radius: var(--radius-sm);
            text-decoration: none;
        }

        .action-btn-edit:hover {
            background: #f8f9fa;
            color: var(--brand-primary);
            border-color: #adb5bd;
        }

        .action-btn-delete:hover {
            background: #f8f9fa;
            color: #dc3545;
            border-color: #dc3545;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: var(--text-secondary);
            font-size: 1rem;
            margin: 0;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-posters');
            if (el) {
                Sortable.create(el, {
                    handle: '.handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function() {
                        let order = [];
                        el.querySelectorAll('tr').forEach((row, index) => {
                            order.push({
                                id: row.dataset.id,
                                position: index + 1
                            });
                        });

                        fetch('{{ route("admin.posters.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Reordered!',
                                    text: 'Banner sequence updated successfully.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection

@section('content')

    <!-- Stats Row -->
    <div class="poster-stats">
        <div class="stat-mini">
            <div class="stat-mini-icon primary"><i class="bi bi-images"></i></div>
            <div class="stat-mini-text">
                <div class="num">{{ $posters->count() }}</div>
                <div class="label">Total Posters</div>
            </div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-icon success"><i class="bi bi-check-circle"></i></div>
            <div class="stat-mini-text">
                <div class="num">{{ $posters->where('status', 1)->count() }}</div>
                <div class="label">Active</div>
            </div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-icon secondary"><i class="bi bi-eye-slash"></i></div>
            <div class="stat-mini-text">
                <div class="num">{{ $posters->where('status', 0)->count() }}</div>
                <div class="label">Inactive</div>
            </div>
        </div>
    </div>

    <!-- Live Preview -->
    <div class="preview-card">
        <div class="preview-header">
            <div class="ph-left">
                <i class="bi bi-display"></i>
                <div>
                    <h6>Homepage Banner Preview</h6>
                    <small>Scroll to see how active posters will appear on your storefront</small>
                </div>
            </div>
            <div class="live-dot">LIVE</div>
        </div>
        <div class="preview-carousel">
            @php $activePosters = $posters->where('status', 1); @endphp
            @if($activePosters->count() > 0)
                <div class="preview-slider">
                    @foreach($activePosters as $poster)
                        <div class="preview-slide">
                            <img src="{{ asset($poster->image) }}" alt="{{ $poster->title }}">
                            <div class="preview-slide-overlay">
                                <span class="preview-slide-title">{{ $poster->title ?? 'Untitled' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="preview-empty">
                    <i class="bi bi-image"></i>
                    <p>No active posters to preview. Activate a poster to see it here.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Poster List -->
    <div class="poster-list-card">
        <div class="poster-list-header">
            <div class="plh-left">
                <h6>All Posters</h6>
                <span class="badge bg-secondary ms-2">{{ $posters->count() }}</span>
            </div>
            <a href="{{ route('admin.posters.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add Poster
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th style="width: 100px;">Preview</th>
                        <th>Details</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 100px;" class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortable-posters">
                    @forelse($posters as $item)
                        <tr data-id="{{ $item->id }}">
                            <td>
                                <i class="bi bi-grip-vertical handle"></i>
                            </td>
                            <td>
                                <div class="poster-thumb-wrap">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                </div>
                            </td>
                            <td>
                                <div class="poster-info">
                                    <span class="poster-name">{{ $item->title ?? 'Untitled Poster' }}</span>
                                    <span class="poster-meta">
                                        @if($item->link)
                                            <i class="bi bi-link-45deg"></i> {{ Str::limit($item->link, 30) }} ·
                                        @endif
                                        Added {{ $item->created_at ? $item->created_at->diffForHumans() : 'recently' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if($item->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.posters.edit', $item->id) }}"
                                        class="action-btn action-btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.posters.destroy', $item->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this poster?');">
                                        @csrf
                                        <button type="submit" class="action-btn action-btn-delete ms-1" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-images"></i>
                                    <p>No posters yet. Click <strong>"Add Poster"</strong> to create your first banner.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection