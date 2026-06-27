@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('admin.custom_orders.index') }}" class="btn btn-sm btn-light border rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mb-0 text-dark fw-bold">Custom Order Details</h4>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0">Design Description</h5>
            </div>
            <div class="card-body p-4">
                <p class="text-secondary" style="line-height: 1.8;">{{ $customOrder->description }}</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0">Uploaded Designs</h5>
            </div>
            <div class="card-body p-4">
                @if(is_array($customOrder->images) && count($customOrder->images) > 0)
                    <div class="row g-3">
                        @foreach($customOrder->images as $img)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $img) }}" alt="Design" class="img-fluid rounded shadow-sm" style="height: 200px; width: 100%; object-fit: cover; border: 1px solid #eaeaea; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center my-4">No images uploaded.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h6 class="fw-bold mb-0 text-uppercase text-secondary" style="letter-spacing: 1px; font-size: 0.8rem;">Customer Info</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div>
                        <div class="small text-muted mb-1">Name</div>
                        <div class="fw-bold text-dark">{{ $customOrder->name }}</div>
                    </div>
                    <div>
                        <div class="small text-muted mb-1">Phone</div>
                        <div class="fw-bold text-dark">{{ $customOrder->phone }}</div>
                    </div>
                    <div>
                        <div class="small text-muted mb-1">Email</div>
                        <div class="fw-bold text-dark">{{ $customOrder->email }}</div>
                    </div>
                    <div>
                        <div class="small text-muted mb-1">Submitted At</div>
                        <div class="fw-bold text-dark">{{ $customOrder->created_at->format('d M, Y \a\t h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h6 class="fw-bold mb-0 text-uppercase text-secondary" style="letter-spacing: 1px; font-size: 0.8rem;">Order Status</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.custom_orders.updateStatus', $customOrder->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="status" class="form-select border-0 bg-light">
                            <option value="pending" {{ $customOrder->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="reviewed" {{ $customOrder->status == 'reviewed' ? 'selected' : '' }}>Reviewed (Contacting)</option>
                            <option value="accepted" {{ $customOrder->status == 'accepted' ? 'selected' : '' }}>Accepted / Quoted</option>
                            <option value="completed" {{ $customOrder->status == 'completed' ? 'selected' : '' }}>Completed / Ordered</option>
                            <option value="rejected" {{ $customOrder->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-medium">Update Status</button>
                </form>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customOrder->phone) }}" target="_blank" class="btn btn-success w-100 py-2 fw-medium rounded text-white d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-whatsapp"></i> Chat with Customer
            </a>
        </div>
    </div>
</div>
@endsection
