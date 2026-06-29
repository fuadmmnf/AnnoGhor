@extends('layouts.admin')

@section('title', 'Category List')

@section('content')
    <style>
        /* 🎨 Custom Compact & Modern Admin Card */
        .modern-admin-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }

        /* 🟢 Alerts (Compact) */
        .custom-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            color: #166534;
            font-weight: 500;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* 🔍 Modern Search Bar (Compact) */
        .modern-search-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .modern-search-form {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 280px;
            height: 38px;
        }

        .modern-search-form:focus-within {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
            background: #ffffff;
        }

        .modern-search-form input {
            border: none;
            padding: 8px 12px;
            outline: none;
            width: 100%;
            background: transparent;
            font-size: 13px;
            color: #334155;
        }

        .modern-search-form button {
            background: transparent;
            border: none;
            padding: 8px 12px;
            color: #64748b;
            cursor: pointer;
            transition: color 0.3s;
        }

        /* 🔽 Custom Select */
        .custom-select-box {
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
            font-size: 13px;
            color: #334155;
            outline: none;
            cursor: pointer;
            height: 38px;
        }

        /* 📊 Responsive Table Styles (Fixed for Mobile) */
        .table-responsive {
            display: block; /* মোবাইলে স্ক্রল করানোর জন্য জরুরি */
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .modern-table {
            width: 100%;
            min-width: 900px; /* 🔥 এই লাইনের কারণে মোবাইলে টেবিল আর ভাঙবে না, স্ক্রল হবে */
            border-collapse: collapse;
        }

        .modern-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            font-size: 13px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .modern-table td {
            padding: 10px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        .modern-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* 🏷️ Subcategory Badges (Slim) */
        .sub-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            margin-right: 4px;
            margin-bottom: 6px;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            white-space: nowrap; /* সাবক্যাটাগরি ব্যাজগুলো যেন না ভাঙে */
        }

        /* 🔢 Number Badges (Slim) */
        .stat-badge {
            background: #eff6ff;
            color: #2563eb;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
        }
        .sale-badge {
            color: #059669;
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
        }

        /* 🛠️ Action Buttons */
        .action-flex {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-edit { background: #eff6ff; color: #2563eb; }
        .btn-edit:hover { background: #dbeafe; transform: translateY(-1px); }
        .btn-delete { background: #fef2f2; color: #dc2626; }
        .btn-delete:hover { background: #fee2e2; transform: translateY(-1px); }

        /* Add Button Slim */
        .btn-add-slim {
            background: #2377fc;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            height: 38px;
            transition: 0.3s;
            white-space: nowrap;
        }
        .btn-add-slim:hover {
            background: #1a5ac0;
            color: #fff;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center justify-between gap20 mb-15 flex-wrap" style="margin-bottom: 15px;">
                    <h4 class="fw-bold m-0" style="color: #0f172a;">All Categories</h4>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10 m-0">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny text-muted">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right text-muted" style="font-size: 10px;"></i></li>
                        <li><div class="text-tiny fw-bold" style="color: #6366f1;">Category List</div></li>
                    </ul>
                </div>

                @if(session('success'))
                    <div class="custom-alert">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <div class="modern-admin-card wg-box">
                    
                    <div class="flex items-center justify-between gap15 flex-wrap mb-4">
                        
                        <div class="modern-search-wrapper">
                            <div class="flex items-center gap10">
                                <span class="text-tiny fw-bold text-muted">Show</span>
                                <select name="per_page" class="custom-select-box" onchange="this.form.submit()" form="searchForm">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                </select>
                            </div>

                            <form id="searchForm" method="GET" action="{{ route('admin.category-list') }}" class="modern-search-form">
                                <input type="text" placeholder="Search categories..." name="name" value="{{ request('name') }}">
                                <button type="submit">
                                    <i class="icon-search"></i>
                                </button>
                            </form>
                        </div>

                        <a class="btn-add-slim" href="{{ route('admin.add-category') }}">
                            <i class="icon-plus"></i> Add New Category
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Subcategories</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Sold</th>
                                    <th class="text-right" style="text-align: right;">Total Sale</th>
                                    <th class="text-center" style="width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            <span class="fw-bold" style="color: #1e293b; font-size: 14px; white-space: nowrap;">{{ $category->name }}</span>
                                        </td>

                                        <td style="white-space: normal; line-height: 1.8; min-width: 250px;">
                                            @forelse($category->subcategories as $subcategory)
                                                <span class="sub-badge">{{ $subcategory->name }}</span>
                                            @empty
                                                <span class="text-muted" style="font-size: 12px; font-style: italic;">No subcategories</span>
                                            @endforelse
                                        </td>

                                        <td class="text-center">
                                            <span class="stat-badge">{{ $category->products_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="stat-badge" style="background: #fdf4ff; color: #c026d3;">{{ $category->total_sold_quantity ?? 0 }}</span>
                                        </td>
                                        <td style="text-align: right;">
                                            <span class="sale-badge">৳ {{ number_format($category->total_sale_amount ?? 0, 2) }}</span>
                                        </td>

                                        <td>
                                            <div class="action-flex">
                                                <a href="{{ route('admin.edit-category', $category->id) }}" class="btn-action btn-edit" title="Edit">
                                                    <i class="icon-edit-3"></i>
                                                </a>
                                                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Delete">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div style="text-align: center; padding: 30px; color: #64748b;">
                                                <i class="icon-search mb-2" style="font-size: 24px; color: #cbd5e1;"></i>
                                                <div class="fw-bold text-muted">No categories found matching your search.</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap10 mt-3 pt-3" style="border-top: 1px solid #f1f5f9;">
                        <div class="text-tiny text-muted fw-bold">
                            Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries
                        </div>
                        
                        <div class="wg-pagination" style="transform: scale(0.9); transform-origin: right center;">
                            {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bottom-page" style="margin-top: 20px;">
            <div class="body-text text-tiny text-muted">Copyright © 2026 Earth Annoghor. All rights reserved. Designed and Developed by <a href="https://innovatechbd.net/" target="_blank" style="color: #6366f1; font-weight: 600;">Innovatech</a></div>
        </div>
    </div>
@endsection