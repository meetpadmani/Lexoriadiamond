@include('frontend.navbar')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --raj-maroon: #0F1F17;
        --raj-gold: #c5a059;
        --raj-gold-light: #dfc187;
        --raj-sand: #ffffff;
        --raj-sand-light: #fbfbfb;
        --raj-grey: #8a8a8a;
        --raj-border: #eaeaea;
        --font-heading: 'Playfair Display', serif;
        --font-accent: 'Inter', sans-serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        font-family: var(--font-body);
        color: var(--raj-maroon);
        background-color: var(--raj-sand-light);
        -webkit-font-smoothing: antialiased;
    }

    .profile-hero {
        padding: 80px 20px 60px;
        text-align: center;
        background: linear-gradient(to bottom, #f0f0f0, var(--raj-sand-light));
        border-bottom: 1px solid var(--raj-border);
    }

    .profile-hero h1 {
        font-family: var(--font-heading);
        font-size: 3.5rem;
        color: var(--raj-maroon);
        margin: 0;
        font-weight: 500;
        letter-spacing: -0.5px;
    }

    .profile-hero p {
        font-family: var(--font-accent);
        color: var(--raj-grey);
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 0.85rem;
        margin-top: 15px;
    }

    .profile-container {
        max-width: 1400px;
        margin: 60px auto 100px;
        padding: 0 40px;
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 60px;
        align-items: start;
    }

    /* SIDEBAR */
    .profile-sidebar {
        background-color: var(--raj-maroon);
        border-radius: 16px;
        padding: 40px 30px;
        color: var(--raj-sand);
        box-shadow: 0 20px 40px rgba(15, 31, 23, 0.1);
        position: sticky;
        top: 100px;
    }

    .user-info {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        background: var(--raj-gold);
        color: var(--raj-maroon);
        font-family: var(--font-heading);
        font-size: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 20px;
    }

    .user-name {
        font-family: var(--font-heading);
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .user-email {
        font-family: var(--font-accent);
        font-size: 0.85rem;
        color: rgba(255,255,255,0.6);
    }

    .profile-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-btn {
        width: 100%;
        background: transparent;
        border: none;
        color: rgba(255,255,255,0.7);
        padding: 15px 20px;
        text-align: left;
        font-family: var(--font-accent);
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 15px;
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .nav-btn:hover {
        background: rgba(255,255,255,0.05);
        color: var(--raj-sand);
    }

    .nav-btn.active {
        background: var(--raj-gold);
        color: var(--raj-maroon);
        font-weight: 500;
    }

    /* CONTENT AREA */
    .profile-content {
        background: var(--raj-sand);
        border-radius: 16px;
        padding: 50px;
        border: 1px solid var(--raj-border);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        min-height: 600px;
    }

    .tab-pane {
        display: none;
        animation: fadeUp 0.4s ease;
    }

    .tab-pane.active {
        display: block;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-title {
        font-family: var(--font-heading);
        font-size: 2rem;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--raj-border);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* DASHBOARD CARDS */
    .dash-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .dash-card {
        background: var(--raj-sand-light);
        border: 1px solid var(--raj-border);
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .dash-card:hover {
        border-color: var(--raj-gold);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(197, 160, 89, 0.1);
    }

    .dash-card i {
        font-size: 2.5rem;
        color: var(--raj-gold);
        margin-bottom: 15px;
        display: block;
    }

    .dash-card h3 {
        font-family: var(--font-heading);
        font-size: 2.5rem;
        margin: 0 0 5px;
        color: var(--raj-maroon);
    }

    .dash-card p {
        font-family: var(--font-accent);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        color: var(--raj-grey);
        margin: 0;
    }

    /* TABLES */
    .raj-table {
        width: 100%;
        border-collapse: collapse;
    }

    .raj-table th {
        font-family: var(--font-accent);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1.5px;
        color: var(--raj-grey);
        padding: 20px 15px;
        border-bottom: 1px solid var(--raj-border);
        text-align: left;
    }

    .raj-table td {
        padding: 20px 15px;
        border-bottom: 1px solid var(--raj-border);
        font-size: 1rem;
        vertical-align: middle;
    }

    /* BUTTONS & FORMS */
    .btn-raj {
        background: var(--raj-maroon);
        color: var(--raj-sand);
        border: none;
        padding: 14px 30px;
        font-family: var(--font-accent);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }

    .btn-raj:hover {
        background: var(--raj-gold);
        color: var(--raj-sand);
    }

    .btn-raj-outline {
        background: transparent;
        color: var(--raj-maroon);
        border: 1px solid var(--raj-border);
        padding: 10px 20px;
        font-family: var(--font-accent);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-raj-outline:hover {
        border-color: var(--raj-gold);
        color: var(--raj-gold);
    }

    .raj-input {
        width: 100%;
        padding: 16px 20px;
        border: 1px solid var(--raj-border);
        border-radius: 8px;
        font-family: var(--font-body);
        font-size: 1rem;
        background: var(--raj-sand-light);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .raj-input:focus {
        outline: none;
        border-color: var(--raj-gold);
        background: var(--raj-sand);
        box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
    }

    label {
        display: block;
        font-family: var(--font-accent);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--raj-grey);
        margin-bottom: 8px;
    }

    /* WISHLIST GRID */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
    }

    .wishlist-item {
        border: 1px solid var(--raj-border);
        border-radius: 12px;
        padding: 20px;
        background: var(--raj-sand-light);
        text-align: center;
        transition: all 0.3s ease;
    }

    .wishlist-item:hover {
        border-color: var(--raj-gold);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }

    .wishlist-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .wishlist-item h4 {
        font-family: var(--font-heading);
        font-size: 1.2rem;
        margin: 0 0 5px;
    }

    .wishlist-item p {
        color: var(--raj-gold);
        font-weight: 600;
        margin: 0 0 15px;
    }

    .raj-alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        font-family: var(--font-accent);
        font-size: 0.95rem;
    }

    .raj-alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .raj-alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    @media (max-width: 992px) {
        .profile-container { grid-template-columns: 1fr; }
        .profile-sidebar { position: static; }
    }
</style>

<div class="profile-hero">
    <h1>My Account</h1>
    <p>Manage your luxury experience</p>
</div>

<div class="profile-container">
    <aside class="profile-sidebar">
        <div class="user-info">
            <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
            <div class="user-name">{{ $user->name }}</div>
            <div class="user-email">{{ $user->email }}</div>
        </div>

        <ul class="profile-nav">
            <li><button class="nav-btn active" data-target="dashboard"><i class="bi bi-grid"></i> Dashboard</button></li>
            <li><button class="nav-btn" data-target="orders"><i class="bi bi-box-seam"></i> Order History</button></li>
            <li><button class="nav-btn" data-target="wishlist"><i class="bi bi-heart"></i> Wishlist</button></li>
            <li><button class="nav-btn" data-target="digital"><i class="bi bi-cloud-arrow-down"></i> Digital Downloads</button></li>
            <li><button class="nav-btn" data-target="settings"><i class="bi bi-person-gear"></i> Account Settings</button></li>
            <li><button class="nav-btn" data-target="password"><i class="bi bi-shield-lock"></i> Security</button></li>
            <li style="margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="nav-btn" style="color: #fca5a5;"><i class="bi bi-box-arrow-right"></i> Sign Out</button>
                </form>
            </li>
        </ul>
    </aside>

    <main class="profile-content">
        @if (session('success'))
            <div class="raj-alert raj-alert-success"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="raj-alert raj-alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="raj-alert raj-alert-danger">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="tab-pane active" id="tab-dashboard">
            <h2 class="section-title"><i class="bi bi-grid"></i> Dashboard</h2>
            <div class="dash-grid">
                <div class="dash-card">
                    <i class="bi bi-box-seam"></i>
                    <h3>{{ $orders->total() }}</h3>
                    <p>Total Orders</p>
                </div>
                <div class="dash-card">
                    <i class="bi bi-heart"></i>
                    <h3>{{ $wishlists->count() }}</h3>
                    <p>Wishlist Items</p>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab-orders">
            <h2 class="section-title"><i class="bi bi-box-seam"></i> Order History</h2>
            @if($orders->count() > 0)
                <table class="raj-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td style="font-weight: 500;">#{{ $order->order_number }}</td>
                            <td style="color: var(--raj-grey);">{{ $order->created_at->format('M d, Y') }}</td>
                            <td style="font-weight: 500;">${{ number_format($order->total_amount, 2) }}</td>
                            <td><a href="{{ route('orders.show', $order->order_number) }}" class="btn-raj-outline">View Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 30px;">{{ $orders->links() }}</div>
            @else
                <div style="text-align: center; padding: 60px 0;">
                    <i class="bi bi-box-seam" style="font-size: 4rem; color: var(--raj-border); margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-family: var(--font-heading); margin-bottom: 10px;">No Orders Yet</h3>
                    <p style="color: var(--raj-grey); margin-bottom: 30px;">You haven't placed any orders.</p>
                    <a href="{{ route('collections') }}" class="btn-raj">Browse Collections</a>
                </div>
            @endif
        </div>

        <div class="tab-pane" id="tab-wishlist">
            <h2 class="section-title"><i class="bi bi-heart"></i> Wishlist</h2>
            @if($wishlists->count() > 0)
                <div class="wishlist-grid">
                    @foreach($wishlists as $wishlist)
                        @if($wishlist->product)
                        <div class="wishlist-item">
                            <img src="{{ str_starts_with($wishlist->product->main_image, 'http') ? $wishlist->product->main_image : asset('storage/' . $wishlist->product->main_image) }}" alt="{{ $wishlist->product->name }}">
                            <h4>{{ $wishlist->product->name }}</h4>
                            <p>${{ number_format($wishlist->product->sale_price ?? $wishlist->product->regular_price, 2) }}</p>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('collections.product', [$wishlist->product->collection->slug ?? 'collection', $wishlist->product->slug]) }}" class="btn-raj-outline" style="flex:1; text-align:center;">View</a>
                                <form action="{{ route('wishlist.remove') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                    <button type="submit" class="btn-raj-outline" style="color: #ef4444; border-color: #fecaca;"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 60px 0;">
                    <i class="bi bi-heart" style="font-size: 4rem; color: var(--raj-border); margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-family: var(--font-heading); margin-bottom: 10px;">Empty Wishlist</h3>
                    <p style="color: var(--raj-grey); margin-bottom: 30px;">Save items you love.</p>
                    <a href="{{ route('collections') }}" class="btn-raj">Discover Jewelry</a>
                </div>
            @endif
        </div>

        <div class="tab-pane" id="tab-digital">
            <h2 class="section-title"><i class="bi bi-cloud-arrow-down"></i> Digital Downloads</h2>
            @php
                $digitalProducts = collect();
                foreach($orders as $order) {
                    foreach($order->items as $item) {
                        if($item->product && $item->product->is_digital && $item->product->digital_file_path) {
                            $digitalProducts->push($item->product);
                        }
                    }
                }
                $digitalProducts = $digitalProducts->unique('id');
            @endphp
            @if($digitalProducts->count() > 0)
                <div class="dash-grid">
                    @foreach($digitalProducts as $product)
                    <div class="dash-card" style="text-align: left;">
                        <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 20px;">
                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            <div>
                                <h4 style="margin: 0; font-family: var(--font-heading); font-size: 1.1rem;">{{ $product->name }}</h4>
                                <p style="margin: 5px 0 0; font-size: 0.8rem; color: var(--raj-grey);"><i class="bi bi-file-zip"></i> Digital File</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.download', $product->id) }}" class="btn-raj-outline" style="width: 100%; text-align: center;"><i class="bi bi-download me-2"></i> Download File</a>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 60px 0;">
                    <i class="bi bi-cloud-arrow-down" style="font-size: 4rem; color: var(--raj-border); margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-family: var(--font-heading); margin-bottom: 10px;">No Digital Assets</h3>
                    <p style="color: var(--raj-grey);">You haven't purchased any digital products.</p>
                </div>
            @endif
        </div>

        <div class="tab-pane" id="tab-settings">
            <h2 class="section-title"><i class="bi bi-person-gear"></i> Account Settings</h2>
            <form action="{{ route('profile.update') }}" method="POST" style="max-width: 600px;">
                @csrf
                <label>Full Name</label>
                <input type="text" name="name" class="raj-input" value="{{ old('name', $user->name) }}" required>
                
                <label>Email Address</label>
                <input type="email" class="raj-input" value="{{ $user->email }}" disabled style="opacity: 0.6; cursor: not-allowed;">
                
                <label>Phone Number</label>
                <input type="text" name="phone" class="raj-input" value="{{ old('phone', $user->phone) }}">
                
                <button type="submit" class="btn-raj mt-3">Save Changes</button>
            </form>
        </div>

        <div class="tab-pane" id="tab-password">
            <h2 class="section-title"><i class="bi bi-shield-lock"></i> Security</h2>
            <form action="{{ route('profile.password') }}" method="POST" style="max-width: 600px;">
                @csrf
                <label>Current Password</label>
                <input type="password" name="current_password" class="raj-input" required>
                
                <label>New Password</label>
                <input type="password" name="new_password" class="raj-input" required>
                
                <label>Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="raj-input" required>
                
                <button type="submit" class="btn-raj mt-3">Update Password</button>
            </form>
        </div>

    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navBtns = document.querySelectorAll('.nav-btn[data-target]');
        const tabPanes = document.querySelectorAll('.tab-pane');

        navBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                navBtns.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                const targetId = 'tab-' + this.getAttribute('data-target');
                const targetPane = document.getElementById(targetId);
                if(targetPane) targetPane.classList.add('active');
            });
        });
    });
</script>

@include('frontend.footer')
