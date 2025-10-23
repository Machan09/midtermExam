@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Header Styles */
    .header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 20px 30px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #ff6b6b, #feca57);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
    }

    .header-title {
        color: white;
        font-size: 28px;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .nav-links {
        display: flex;
        gap: 20px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .nav-link:hover, .nav-link.active {
        color: white;
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Action Bar */
    .action-bar {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .add-product-btn {
        background: linear-gradient(45deg, #4CAF50, #45a049);
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
        border: none;
        cursor: pointer;
    }

    .add-product-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.6);
    }

    .search-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input {
        width: 300px;
        padding: 12px 20px 12px 45px;
        border: 2px solid #e1e5e9;
        border-radius: 25px;
        font-size: 16px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        color: #999;
        font-size: 18px;
    }

    .search-btn {
        background: #667eea;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        margin-left: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #5a6fd8;
        transform: translateY(-2px);
    }

    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .product-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .product-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .product-name {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
        position: relative;
        z-index: 1;
    }

    .product-category {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        position: relative;
        z-index: 1;
    }

    .product-body {
        padding: 25px;
    }

    .product-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .detail-item {
        text-align: center;
    }

    .detail-label {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .detail-value {
        font-size: 18px;
        font-weight: 700;
        color: #333;
    }

    .price-value {
        color: #4CAF50;
    }

    .quantity-value {
        color: #2196F3;
    }

    /* Stock Status */
    .stock-status {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        z-index: 2;
    }

    .stock-high {
        background: rgba(76, 175, 80, 0.9);
        color: white;
    }

    .stock-medium {
        background: rgba(255, 193, 7, 0.9);
        color: white;
    }

    .stock-low {
        background: rgba(244, 67, 54, 0.9);
        color: white;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        min-width: 80px;
        text-align: center;
    }

    .btn-view {
        background: linear-gradient(45deg, #2196F3, #1976D2);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(45deg, #FF9800, #F57C00);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(45deg, #F44336, #D32F2F);
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Empty State */
    .empty-state {
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-description {
        color: #666;
        font-size: 16px;
        margin-bottom: 30px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .action-bar {
            flex-direction: column;
            text-align: center;
        }

        .search-input {
            width: 100%;
            max-width: 300px;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .nav-links {
            flex-direction: column;
            width: 100%;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .product-card:nth-child(2) { animation-delay: 0.1s; }
    .product-card:nth-child(3) { animation-delay: 0.2s; }
    .product-card:nth-child(4) { animation-delay: 0.3s; }
    .product-card:nth-child(5) { animation-delay: 0.4s; }
    .product-card:nth-child(6) { animation-delay: 0.5s; }

    /* Toast Notifications */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
    }

    .toast-success {
        background: linear-gradient(45deg, #4CAF50, #45a049);
    }

    .toast-error {
        background: linear-gradient(45deg, #F44336, #D32F2F);
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="logo">📦</div>
                <h1 class="header-title">Inventory TPS</h1>
            </div>
            <nav class="nav-links">
                <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
                <a href="{{ route('products.index') }}" class="nav-link active">Products</a>
            </nav>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="action-bar">
        <div>
            <a href="{{ route('products.create') }}" class="add-product-btn">
                + Add Product
            </a>
        </div>
        
        <div class="search-container">
            <form method="GET" action="{{ route('products.index') }}" style="display: flex; align-items: center;">
                <div style="position: relative;">
                    <span class="search-icon">🔍</span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search products..." 
                           class="search-input">
                </div>
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    @if(isset($products) && count($products) > 0)
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <!-- Stock Status Badge -->
                @php
                    $quantity = $product->quantity ?? 0;
                    if($quantity > 50) {
                        $stockClass = 'stock-high';
                        $stockText = 'High Stock';
                    } elseif($quantity > 10) {
                        $stockClass = 'stock-medium';
                        $stockText = 'Low Stock';
                    } else {
                        $stockClass = 'stock-low';
                        $stockText = 'Critical';
                    }
                @endphp
                <div class="stock-status {{ $stockClass }}">{{ $stockText }}</div>

                <!-- Product Header -->
                <div class="product-header">
                    <h3 class="product-name">{{ $product->name ?? 'Product Name' }}</h3>
                    <span class="product-category">
                        {{ $product->category->name ?? 'General' }}
                    </span>
                </div>

                <!-- Product Body -->
                <div class="product-body">
                    <div class="product-details">
                        <div class="detail-item">
                            <div class="detail-label">Quantity</div>
                            <div class="detail-value quantity-value">
                                {{ $product->quantity ?? 0 }}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Price</div>
                            <div class="detail-value price-value">
                                ₱{{ number_format($product->price ?? 0, 2) }}
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ route('products.show', $product->id ?? 1) }}" class="btn btn-view">View</a>
                        <a href="{{ route('products.edit', $product->id ?? 1) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('products.destroy', $product->id ?? 1) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                    class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <h2 class="empty-title">No Products Found</h2>
            <p class="empty-description">
                You haven't added any products yet. Start by adding your first product to get started.
            </p>
            <a href="{{ route('products.create') }}" class="add-product-btn">
                + Add Your First Product
            </a>
        </div>
    @endif
</div>

<!-- Toast Notifications -->
@if(session('success'))
<div class="toast toast-success" id="success-toast">
    ✅ {{ session('success') }}
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.style.animation = 'slideInRight 0.3s ease-out reverse';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
@endif

@if(session('error'))
<div class="toast toast-error" id="error-toast">
    ❌ {{ session('error') }}
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('error-toast');
        if (toast) {
            toast.style.animation = 'slideInRight 0.3s ease-out reverse';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
@endif

<script>
// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to search input
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    }

    // Add click animation to buttons
    document.querySelectorAll('.btn, .add-product-btn, .search-btn').forEach(button => {
        button.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection