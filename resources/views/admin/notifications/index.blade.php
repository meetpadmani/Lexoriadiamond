@extends('admin.layout')

@section('title', 'Notifications')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-bell me-2 text-primary"></i> Recent Activity</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($notifications as $notif)
                            <a href="{{ $notif->link }}" class="list-group-item list-group-item-action py-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-{{ $notif->color }}-subtle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi {{ $notif->icon }} text-{{ $notif->color }} fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-1 fw-bold">{{ $notif->title }}</h6>
                                            <small class="text-muted">{{ $notif->time }}</small>
                                        </div>
                                        <p class="mb-0 text-muted small">{{ $notif->message }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-bell-slash text-muted display-1 mb-3"></i>
                                <p class="text-muted">No new notifications at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
