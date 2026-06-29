@extends('layouts.admin')

@section('title', 'All Banners')

@section('content')
    <style>
        /* 🎨 Custom Modern Admin Styles */
        .modern-admin-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
        }

        /* 🟢 Modern Alert Box */
        .custom-alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            color: #166534;
            font-weight: 500;
            margin-bottom: 24px;
        }

        /* 📊 Responsive Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .modern-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 14px;
            padding: 16px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        .modern-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        .modern-table tbody tr:hover {
            background-color: #f8fafc;
            transition: background-color 0.2s ease;
        }

        /* 🖼️ Image Thumbnail */
        .modern-img-thumb {
            width: 120px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .modern-img-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* 🏷️ Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-type { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        .badge-active { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .badge-inactive { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        /* 🗑️ Action Button */
        .action-btn {
            background: transparent;
            border: none;
            color: #ef4444;
            font-size: 18px;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            cursor: pointer;
        }
        .action-btn:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* 📭 Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px dashed #e2e8f0;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="fw-bold" style="color: #0f172a;">All Banners</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny text-muted">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li><div class="text-tiny fw-bold" style="color: #6366f1;">Banners</div></li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="custom-alert">
                        <i class="fas fa-check-circle" style="font-size: 20px;"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <div class="modern-admin-card wg-box">
                    
                    <div class="flex items-center justify-between gap10 flex-wrap mb-4">
                        <div class="fw-bold" style="font-size: 18px; color: #1e293b;">Banner List</div>
                        <a class="tf-button style-1" href="{{ route('admin.banners.create') }}" style="border-radius: 10px; padding: 12px 24px;">
                            <i class="icon-plus me-2"></i> Add New Banner
                        </a>
                    </div>

                    @if ($banners->isEmpty())
                        <div class="empty-state mt-4">
                            <i class="fas fa-images mb-3" style="font-size: 48px; color: #cbd5e1;"></i>
                            <h5 class="text-muted fw-bold">No banners found</h5>
                            <p class="text-tiny text-muted mt-2">Click on "Add New Banner" to create your first banner.</p>
                        </div>
                    @else
                        <div class="table-responsive mt-2">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th style="width: 150px;">Image</th>
                                        <th>Type</th>
                                        <th>Link / Category</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>
                                                <div class="modern-img-thumb">
                                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner">
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-type">{{ ucfirst(str_replace('_', ' ', $banner->type)) }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold" style="color: #475569;">
                                                    @if($banner->category_id)
                                                        <i class="fas fa-folder text-muted me-1"></i> {{ $banner->category->name }}
                                                    @else
                                                        <i class="fas fa-link text-muted me-1"></i> {{ $banner->link ?? 'No Link' }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <span class="badge {{ $banner->status == 1 ? 'badge-active' : 'badge-inactive' }}">
                                                    {{ $banner->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner? This action cannot be undone.')" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn" title="Delete Banner">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection