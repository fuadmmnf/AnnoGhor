@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Product List</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="{{ route('admin.product-list') }}">
                                <div class="text-tiny">Ecommerce</div>
                            </a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Product List</div>
                        </li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                @endif

                <div class="wg-box">
                    <!-- Filter & Search Section -->
                    <form method="GET" action="{{ route('admin.product-list') }}" class="filter-form-wrapper">
                        <div class="filter-row">
                            <!-- Left Side: Filters -->
                            <div class="filters-left">
                                <div class="filter-item">
                                    <label>Category:</label>
                                    <select name="category" class="filter-select" onchange="this.form.submit()">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="filter-item">
                                    <label>Sort By:</label>
                                    <select name="sort" class="filter-select" onchange="this.form.submit()">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest
                                        </option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest
                                        </option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            Price: High to Low</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            Price: Low to High</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            Name: A-Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            Name: Z-A</option>
                                    </select>
                                </div>

                                <div class="filter-item">
                                    <input type="text" name="search" class="search-input"
                                        placeholder="Search by name or ID..." value="{{ request('search') }}">
                                    <button type="submit" class="search-btn"><i class="icon-search"></i></button>
                                </div>

                                @if (request('category') || request('sort') != 'latest' || request('search'))
                                    <a href="{{ route('admin.product-list') }}" class="clear-btn">Clear</a>
                                @endif
                            </div>

                            <!-- Right Side: Add Button -->
                            <div class="filters-right">
                                <a class="tf-button style-1" href="{{ route('admin.add-product') }}">
                                    <i class="icon-plus"></i>Add Product
                                </a>
                            </div>
                        </div>
                    </form>

                    @if ($products->isEmpty())
                        <div class="text-center py-8">
                            <div class="body-title mb-3">No products found</div>
                            <div class="body-text mb-4">
                                @if (request('search') || request('category'))
                                    No products match your filters.
                                @else
                                    You haven't added any products yet.
                                @endif
                            </div>
                            <a class="tf-button style-1" href="{{ route('admin.add-product') }}">
                                <i class="icon-plus"></i>Add Product
                            </a>
                        </div>
                    @else
                        <!-- Product Table -->
                        <div class="product-table-wrapper">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Image</th>
                                        <th style="width: 35%;">Product Name</th>
                                        <th style="width: 120px;">Product ID</th>
                                        <th style="width: 130px;">Category</th>
                                        <th style="width: 110px; text-align: right;">Price</th>
                                        <th style="width: 100px; text-align: center;">Stock</th>
                                        <th style="width: 100px;">Date</th>
                                        <th style="width: 100px; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <!-- Image -->
                                            <td>
                                                <div class="product-image">
                                                    @if ($product->thumbnail)
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                            alt="{{ $product->name }}">
                                                    @else
                                                        <div class="no-image">
                                                            <i class="icon-image"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Product Name -->
                                            <td>
                                                <a href="{{ route('admin.edit-product', $product->id) }}"
                                                    class="product-name">
                                                    {{ Str::limit($product->name, 60) }}
                                                </a>
                                            </td>

                                            <!-- Product ID -->
                                            <td>
                                                <span class="product-code">{{ $product->product_code }}</span>
                                            </td>

                                            <!-- Category -->
                                            <td>
                                                <span class="category-badge">{{ $product->category->name ?? 'N/A' }}</span>
                                            </td>

                                            <!-- Price -->
                                            <td style="text-align: right;">
                                                @if ($product->discount_price)
                                                    <div class="price-original">
                                                        ৳{{ number_format($product->regular_price, 2) }}</div>
                                                    <div class="price-discount">
                                                        ৳{{ number_format($product->discount_price, 2) }}</div>
                                                @else
                                                    <div class="price-regular">
                                                        ৳{{ number_format($product->regular_price, 2) }}</div>
                                                @endif
                                            </td>

                                            <!-- Stock -->
                                            <td style="text-align: center;">
                                                @if ($product->stock_quantity == 0)
                                                    <div class="stock-badge out-stock">
                                                        <strong>0</strong>
                                                        <div style="font-size: 10px; opacity: 0.8;">Out of Stock</div>
                                                    </div>
                                                @elseif($product->stock_quantity < 10)
                                                    <div class="stock-badge low-stock">
                                                        <strong>{{ $product->stock_quantity }}</strong>
                                                        <div style="font-size: 10px; opacity: 0.8;">Low Stock</div>
                                                    </div>
                                                @else
                                                    <div class="stock-badge in-stock">
                                                        <strong>{{ $product->stock_quantity }}</strong>
                                                        <div style="font-size: 10px; opacity: 0.8;">Available</div>
                                                    </div>
                                                @endif
                                            </td>

                                            <!-- Date -->
                                            <td>
                                                <span
                                                    class="product-date">{{ $product->created_at->format('d M Y') }}</span>
                                            </td>

                                            <!-- Actions -->
                                            <td style="text-align: center;">
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.edit-product', $product->id) }}"
                                                        class="btn-action edit" title="Edit">
                                                        <i class="icon-edit-3"></i>
                                                    </a>

                                                    <form action="{{ route('admin.product.delete', $product->id) }}"
                                                        method="POST" class="delete-form" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-action delete delete-btn"
                                                            data-product-name="{{ $product->name }}" title="Delete">
                                                            <i class="icon-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">
                                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }}
                                of {{ $products->total() }} entries
                            </div>
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Annoghor. All
                rights
                reserved. Designed and Developed </div>
            {{-- <i class="icon-heart"></i> --}}
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productName = this.getAttribute('data-product-name');
                    const form = this.closest('.delete-form');

                    if (confirm(
                            `Are you sure you want to delete "${productName}"?\n\nThis action cannot be undone.`
                            )) {
                        button.disabled = true;
                        button.style.opacity = '0.5';
                        form.submit();
                    }
                });
            });

            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>

    <style>
        /* Alert Styles */
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideInDown 0.3s ease-out;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Filter Form Wrapper */
        .filter-form-wrapper {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .filter-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filters-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filters-right {
            display: flex;
            align-items: center;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-item label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            white-space: nowrap;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            min-width: 150px;
            background: white;
            cursor: pointer;
        }

        .filter-select:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px 0 0 6px;
            font-size: 14px;
            width: 250px;
            border-right: none;
        }

        .search-input:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-btn {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: #0056b3;
        }

        .clear-btn {
            padding: 8px 16px;
            background: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .clear-btn:hover {
            background: #5a6268;
        }

        /* Product Table Styles */
        .product-table-wrapper {
            overflow-x: auto;
            margin: 20px 0;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .product-table thead tr {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .product-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #333;
            white-space: nowrap;
        }

        .product-table tbody tr {
            border-bottom: 1px solid #dee2e6;
            transition: background 0.2s;
        }

        .product-table tbody tr:hover {
            background: #f8f9fa;
        }

        .product-table td {
            padding: 15px 12px;
            vertical-align: middle;
            font-size: 14px;
        }

        /* Product Image */
        .product-image img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .no-image {
            width: 60px;
            height: 60px;
            background: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 24px;
        }

        /* Product Name */
        .product-name {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            display: block;
        }

        .product-name:hover {
            color: #007bff;
        }

        /* Product Code */
        .product-code {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* Category Badge */
        .category-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* Price Styles */
        .price-original {
            text-decoration: line-through;
            color: #999;
            font-size: 12px;
        }

        .price-discount {
            color: #d32f2f;
            font-weight: 600;
            font-size: 14px;
        }

        .price-regular {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        /* Stock Badge */
        .stock-badge {
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .stock-badge.in-stock {
            background: #d4edda;
            color: #155724;
        }

        .stock-badge.out-stock {
            background: #f8d7da;
            color: #721c24;
        }

        /* Product Date */
        .product-date {
            color: #666;
            font-size: 13px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            background: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-action.edit {
            color: #007bff;
            background: #e3f2fd;
        }

        .btn-action.edit:hover {
            background: #007bff;
            color: white;
            transform: scale(1.1);
        }

        .btn-action.delete {
            color: #dc3545;
            background: #f8d7da;
        }

        .btn-action.delete:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .filters-left,
            .filters-right {
                width: 100%;
            }

            .filter-item {
                width: 100%;
            }

            .filter-select,
            .search-input {
                width: 100%;
            }
        }
    </style>
@endsection
