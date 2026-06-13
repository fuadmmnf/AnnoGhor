@extends('layouts.admin')

@section('title', 'Order List')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Order List</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="#">
                                <div class="text-tiny">Order</div>
                            </a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Order List</div>
                        </li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 mb-20" style="flex-wrap: wrap;">
                        <div class="wg-filter flex-grow">
                            <form class="form-search" method="GET" style="display:flex; align-items:center; gap:12px;">
                                <div
                                    style="display:flex; align-items:center; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden; min-width:280px;">
                                    <input type="text" name="name" value="{{ request('name') }}"
                                        placeholder="Search by order ID, email, name..."
                                        style="border:none; outline:none; padding:10px 12px; flex:1;">
                                    <button type="submit" style="border:none; padding:0 14px; background: none;">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>

                                @if (request('name'))
                                    <a href="{{ url()->current() }}" class="tf-button style-1" style="padding: 10px 20px;">
                                        Clear
                                    </a>
                                @endif
                            </form>
                        </div>

                        @if(request()->routeIs('admin.orders.pending') || request()->segment(3) === 'pending' || (!request()->segment(3) && $orders->where('order_status', 'Pending')->count() > 0))
                            <div class="wg-bulk-courier">
                                <form action="{{ route('admin.orders.sendBulk') }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে সমস্ত পেন্ডিং অর্ডার একসাথে স্টেডফাস্ট কুরিয়ারে পাঠাতে চান?')">
                                    @csrf
                                    <button type="submit" class="tf-button style-1" style="padding: 10px 20px; background-color: #10b981; color: white; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; transition: background 0.2s;">
                                        <i class="icon-paper-plane"></i> Send All Pending to Steadfast
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="order-table-wrapper">
                        <div class="table-responsive">
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th style="width: 25%; min-width: 200px;">Customer</th>
                                        <th style="width: 180px; min-width: 150px;">Order ID</th>
                                        <th style="width: 100px; min-width: 80px;">Date</th>
                                        <th style="width: 100px; min-width: 80px; text-align: right;">Total</th>
                                        <th style="width: 80px; min-width: 70px; text-align: center;">Items</th>
                                        <th style="width: 110px; min-width: 90px;">Payment</th>
                                        <th style="width: 120px; min-width: 100px;">Status</th>
                                        <th style="width: 120px; min-width: 100px; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="customer-cell">
                                                    <a href="{{ route('admin.order-detail', $order->id) }}"
                                                        class="customer-name">
                                                        {{ $order->user->name ?? $order->guest_name ?? 'Guest' }}
                                                    </a>
                                                    <div class="customer-email">{{ $order->email }}</div>
                                                    {{-- Guest badge --}}
                                                    @if($order->isGuestOrder())
                                                        <span style="font-size:10px; background:#fff3cd; color:#856404; padding:2px 6px; border-radius:3px; display:inline-block; margin-top:3px;">Guest</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <span class="order-id">{{ $order->order_number }}</span>
                                            </td>

                                            <td>
                                                <span class="order-date">{{ $order->created_at->format('d M Y') }}</span>
                                            </td>

                                            <td style="text-align: right;">
                                                <div class="order-amount">৳{{ number_format($order->total_amount, 2) }}</div>
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="order-items-count">{{ $order->orderItems->count() }}</div>
                                            </td>

                                            <td>
                                                @if ($order->payment_status === 'Success')
                                                    <div class="payment-badge success">Success</div>
                                                @elseif($order->payment_status === 'Pending')
                                                    <div class="payment-badge pending">Pending</div>
                                                @else
                                                    <div class="payment-badge failed">Failed</div>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($order->order_status === 'Delivered')
                                                    <div class="status-badge delivered">Delivered</div>
                                                @elseif($order->order_status === 'Shipped')
                                                    <div class="status-badge shipped">Shipped</div>
                                                @elseif($order->order_status === 'Processing')
                                                    <div class="status-badge processing">Processing</div>
                                                @elseif($order->order_status === 'Cancelled')
                                                    <div class="status-badge cancelled">Cancelled</div>
                                                @else
                                                    <div class="status-badge pending">Pending</div>
                                                @endif
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.order-detail', $order->id) }}"
                                                        class="btn-action view" title="View Details">
                                                        <i class="icon-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.order-tracking', $order->id) }}"
                                                        class="btn-action track" title="Track Order">
                                                        <i class="icon-truck"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="btn-action delete"
                                                        onclick="deleteOrder({{ $order->id }}, '{{ $order->order_number }}')"
                                                        title="Delete">
                                                        <i class="icon-trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-8">
                                                <div class="body-title mb-3">No orders found</div>
                                                @if (request('name'))
                                                    <div class="body-text">No orders match your search.</div>
                                                @else
                                                    <div class="body-text">You don't have any orders yet.</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">
                            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }}
                            of {{ $orders->total() }} entries
                        </div>

                        {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Earth Craft. All rights reserved. Designed and Developed</div>
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>

    <script>
        function deleteOrder(orderId, orderNumber) {
            if (confirm('Are you sure you want to delete order ' + orderNumber + '? This action cannot be undone.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ url('admin/orders') }}/" + orderId + "/delete";

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
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

        .btn-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            float: right;
            color: inherit;
        }

        .order-table-wrapper {
            width: 100%;
            margin: 20px 0;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            table-layout: fixed;
        }

        .order-table thead tr {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .order-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .order-table tbody tr {
            border-bottom: 1px solid #dee2e6;
            transition: background 0.2s;
        }

        .order-table tbody tr:hover {
            background: #f8f9fa;
        }

        .order-table td {
            padding: 15px 12px;
            vertical-align: middle;
            font-size: 14px;
            overflow: hidden;
        }

        .customer-cell {
            min-width: 200px;
            max-width: 100%;
            word-wrap: break-word;
            overflow: hidden;
        }

        .customer-name {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            display: block;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }

        .customer-name:hover {
            color: #007bff;
        }

        .customer-email {
            font-size: 12px;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            width: 100%;
        }

        .order-id {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .order-date { color: #666; white-space: nowrap; }
        .order-amount { font-weight: 600; color: #333; white-space: nowrap; }

        .order-items-count {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            white-space: nowrap;
        }

        .payment-badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            white-space: nowrap;
        }

        .payment-badge.success { background: #d4edda; color: #155724; }
        .payment-badge.pending { background: #fff3cd; color: #856404; }
        .payment-badge.failed  { background: #f8d7da; color: #721c24; }

        .status-badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            white-space: nowrap;
        }

        .status-badge.delivered  { background: #d4edda; color: #155724; }
        .status-badge.shipped    { background: #d1ecf1; color: #0c5460; }
        .status-badge.processing { background: #cce5ff; color: #004085; }
        .status-badge.pending    { background: #fff3cd; color: #856404; }
        .status-badge.cancelled  { background: #f8d7da; color: #721c24; }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: nowrap;
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
            flex-shrink: 0;
        }

        .btn-action.view  { color: #007bff; background: #e3f2fd; }
        .btn-action.view:hover  { background: #007bff; color: white; transform: scale(1.1); }
        .btn-action.track { color: #17a2b8; background: #d1ecf1; }
        .btn-action.track:hover { background: #17a2b8; color: white; transform: scale(1.1); }
        .btn-action.delete { color: #dc3545; background: #f8d7da; }
        .btn-action.delete:hover { background: #dc3545; color: white; transform: scale(1.1); }

        .form-search { display: flex; align-items: center; gap: 12px; }
        .form-search > div { display: flex; align-items: center; border: 1px solid #e5e7eb; border-radius: 6px; overflow: hidden; min-width: 280px; }
        .form-search input[type="text"] { border: none; outline: none; padding: 10px 12px; flex: 1; font-size: 14px; }
        .form-search button[type="submit"] { border: none; padding: 0 14px; background: none; cursor: pointer; color: #666; }
        .form-search button[type="submit"]:hover { color: #007bff; }

        .tf-button.style-1 { padding: 10px 20px; background: #6c757d; color: white; border-radius: 6px; text-decoration: none; font-size: 14px; transition: background 0.3s; border: none; cursor: pointer; }
        .tf-button.style-1:hover { background: #5a6268; }

        .text-center { text-align: center; }
        .py-8 { padding-top: 32px; padding-bottom: 32px; }

        @keyframes slideInDown {
            from { transform: translateY(-20px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        @media (max-width: 768px) {
            .order-table { table-layout: auto; min-width: 1000px; }
            .form-search { flex-direction: column; align-items: stretch; gap: 15px; width: 100%; }
            .form-search > div { min-width: 100% !important; width: 100% !important; }
            .tf-button.style-1 { width: 100%; text-align: center; }
            .flex.items-center.justify-between.gap10.mb-20 { flex-direction: column; align-items: stretch; gap: 15px; }
            .wg-filter.flex-grow { width: 100%; }
            .action-buttons { gap: 5px; }
            .btn-action { width: 28px; height: 28px; font-size: 14px; }
            .customer-email { max-width: 180px; }
            .wg-bulk-courier, .wg-bulk-courier form, .wg-bulk-courier button { width: 100%; }
        }

        @media (max-width: 480px) {
            .order-table { min-width: 1000px; }
            .order-table th, .order-table td { padding: 10px 8px; font-size: 13px; }
            .customer-email { max-width: 150px; font-size: 11px; }
            .order-id, .order-items-count, .payment-badge, .status-badge { font-size: 11px; padding: 3px 8px; }
            .btn-action { width: 26px; height: 26px; font-size: 13px; }
        }
    </style>
@endsection