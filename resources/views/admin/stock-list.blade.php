@extends('layouts.admin')

@section('title', 'Stock History')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Stock History</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Stock History</div></li>
                    </ul>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap mb-24">
                        <div class="body-title">Recent Inventory Logs</div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.add-stock') }}">
                            <i class="icon-plus"></i>Add New Stock
                        </a>
                    </div>

                    @if($stockHistories->isEmpty())
                        <div class="text-center py-8">
                            <div class="body-title mb-3">No stock history found.</div>
                        </div>
                    @else
                        <div class="product-table-wrapper">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Image</th>
                                        <th style="width: 25%;">Product Name</th>
                                        <th style="width: 120px;">Product ID</th>
                                        <th style="width: 130px;">Category</th>
                                        <th style="width: 130px;">Subcategory</th>
                                        <th style="width: 120px; text-align: center;">Added Amount</th>
                                        <th style="width: 150px;">Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stockHistories as $history)
                                        <tr>
                                            <td>
                                                <div class="product-image">
                                                    <img src="{{ $history->product->thumbnail ? asset('storage/' . $history->product->thumbnail) : asset('assets/images/products/default.png') }}" 
                                                         alt="{{ $history->product->name }}">
                                                </div>
                                            </td>
                                            <td><a href="#" class="product-name">{{ $history->product->name }}</a></td>
                                            <td><span class="product-code">{{ $history->product->product_code }}</span></td>
                                            <td><span class="category-badge">{{ $history->product->category->name ?? 'N/A' }}</span></td>
                                            <td><span class="body-text">{{ $history->product->subcategory->name ?? 'N/A' }}</span></td>
                                            <td style="text-align: center;">
                                                <div class="stock-badge in-stock">
                                                    <strong class="tf-color-1">+{{ $history->quantity_added }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-date">
                                                    <div style="font-weight: 600;">
                                                        {{ $history->created_at->timezone('Asia/Dhaka')->format('d M Y') }}
                                                    </div>
                                                    <div style="font-size: 11px; color: #888; margin-top: 2px;">
                                                        <i class="icon-clock"></i> {{ $history->created_at->timezone('Asia/Dhaka')->format('h:i A') }}
                                                    </div>
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
                                Showing {{ $stockHistories->firstItem() ?? 0 }} to {{ $stockHistories->lastItem() ?? 0 }} 
                                of {{ $stockHistories->total() }} logs
                            </div>
                            {{ $stockHistories->links('pagination::bootstrap-4') }}
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

    <style>
        .product-table-wrapper { overflow-x: auto; margin: 20px 0; }
        .product-table { width: 100%; border-collapse: collapse; background: white; }
        .product-table thead tr { background: #f8f9fa; border-bottom: 2px solid #dee2e6; }
        .product-table th { padding: 15px 12px; text-align: left; font-weight: 600; font-size: 14px; color: #333; }
        .product-table tbody tr { border-bottom: 1px solid #dee2e6; transition: background 0.2s; }
        .product-table tbody tr:hover { background: #f8f9fa; }
        .product-table td { padding: 15px 12px; vertical-align: middle; font-size: 14px; }
        .product-image img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #e0e0e0; }
        .product-code { background: #e1fcef; color: #147341; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; }
        .category-badge { background: #e3f2fd; color: #1976d2; padding: 4px 10px; border-radius: 4px; font-size: 12px; }
        .stock-badge.in-stock { background: #e1fcef; color: #147341; padding: 4px 8px; border-radius: 4px; display: inline-block; }
        .tf-color-1 { color: #147341; font-weight: 700; }
        .product-date { line-height: 1.3; }
    </style>
@endsection