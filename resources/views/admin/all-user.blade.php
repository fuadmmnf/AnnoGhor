@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
    <style>
        /* Vertical & Horizontal Scroll Fix */
        .main-content {
            overflow-y: auto !important;
            height: 100vh;
        }
        .wg-box {
            padding: 20px !important; /* Mobile spacing adjustment */
            overflow: visible !important;
        }
        @media (min-width: 768px) {
            .wg-box { padding: 35px !important; }
        }

        /* Search Bar & Icon Fix */
        .form-search {
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-search fieldset { width: 100%; }
        .button-submit {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%)translateY(9px); /* Icon perfectly center korbe */
            background: none !important;
            border: none !important;
        }
        .button-submit button {
            background: transparent !important;
            border: none;
            padding: 0 14px;
        }

        /* Mobile Responsive Table */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 10px;
        }
        
        /* Table Styling */
        .table { min-width: 900px; } /* Slightly increased to fit the role selector smoothly */
        .table-hover tbody tr:hover {
            background-color: #f9f9f9 !important;
            transition: 0.3s;
        }

        /* Role Select Dropdown Custom Styling */
        .role-select {
            height: 36px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            padding: 0 10px;
            cursor: pointer;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            color: #334155;
            transition: all 0.2s;
        }
        .role-select:focus {
            outline: none;
            border-color: #2377FC;
            box-shadow: 0 0 0 3px rgba(35, 119, 252, 0.15);
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 style="font-size: 26px; font-weight: 700; color: #111;">All Registered Users</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny" style="font-size: 15px;">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="#"><div class="text-tiny" style="font-size: 15px;">User</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny" style="font-size: 15px; color: #888;">All Users</div></li>
                    </ul>
                </div>

                {{-- Success Message Alert --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 16px; border-radius: 8px;">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Error Message Alert --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 16px; border-radius: 8px;">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="wg-box" style="border-radius: 15px; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                    <div class="flex items-center justify-between gap10 flex-wrap mb-30">
                        <div class="wg-filter flex-grow">
                            <form class="form-search" method="GET" action="{{ route('admin.all-user') }}">
                                <fieldset class="name" style="max-width: 450px;">
                                    <input type="text" 
                                           placeholder="Search by name or email..." 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           style="height: 50px; font-size: 16px; border: 1px solid #ddd; padding-left: 20px; padding-right: 50px; border-radius: 10px; width: 100%;">
                                </fieldset>
                                <div class="button-submit">
                                    <button type="submit"><i class="icon-search" style="font-size: 20px; color: #666;"></i></button>
                                </div>
                            </form>
                        </div>
                        
                        @if(request('search'))
                            <a href="{{ route('admin.all-user') }}" class="tf-button style-1" style="height: 50px; padding: 0 20px; font-size: 14px; border-radius: 10px;">
                                <i class="icon-x"></i> Clear Search
                            </a>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th class="text-center" style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">No.</th>
                                    <th style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">User Details</th>
                                    <th style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">Email Address</th>
                                    <th style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">Role Management</th>
                                    <th style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">Joined Date</th>
                                    <th class="text-center" style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">Orders</th>
                                    <th class="text-center" style="padding: 15px; font-size: 14px; color: #444; border-bottom: 2px solid #eee;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                    <tr style="background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                        <td class="text-center" style="padding: 15px; font-size: 15px;">
                                            {{ $users->firstItem() + $index }}
                                        </td>
                                        <td style="padding: 15px;">
                                            <div style="font-size: 16px; font-weight: 700; color: #333;">{{ $user->name }}</div>
                                        </td>
                                        <td style="padding: 15px; font-size: 15px; color: #555;">
                                            {{ $user->email }}
                                        </td>
                                        
                                        {{-- রোল আপডেট ড্রপডাউন কলাম --}}
                                        <td style="padding: 15px;">
                                            @if($user->role === 'superadmin')
                                                <span class="badge bg-dark" style="padding: 8px 12px; font-size: 13px;">Super Admin</span>
                                            @else
                                                <form action="{{ route('admin.all-user.update-role', $user->id) }}" method="POST" onchange="this.submit()">
                                                    @csrf
                                                    <select name="role" class="role-select" style="{{ $user->role === 'admin' ? 'border-color: #ef4444; color: #ef4444; background-color: #fef2f2;' : '' }}">
                                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User / Customer</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </form>
                                            @endif
                                        </td>
                                        <td style="padding: 15px; font-size: 15px; color: #555;">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="text-center" style="padding: 15px;">
                                            @if($user->orders_count > 0)
                                                <span style="background: #28a745; color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; white-space: nowrap;">
                                                    {{ $user->orders_count }} Orders
                                                </span>
                                            @else
                                                <span style="background: #f1f1f1; color: #777; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                                    None
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="padding: 15px;">
                                            {{-- 🌟 ডিলিট বাটন --}}
                                            <a href="javascript:void(0)" 
                                               style="display: inline-block; background: #fff1f0; color: #ff4d4f; padding: 10px; border-radius: 8px; border: 1px solid #ffa39e;"
                                               onclick="deleteUser({{ $user->id }}, '{{ addslashes($user->name) }}', {{ $user->orders_count }})">
                                                <i class="icon-trash-2" style="font-size: 18px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5" style="font-size: 16px; color: #999;">No records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="divider mt-20 mb-20" style="border-top: 1px solid #eee;"></div>
                    
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div style="font-size: 14px; color: #666;">
                            Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> to <strong>{{ $users->lastItem() ?? 0 }}</strong> 
                            of <strong>{{ $users->total() }}</strong> users
                        </div>
                        <div class="pagination-wrap">
                            {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © Annoghor. All rights reserved. Designed and Developed </div>
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>

    {{-- 🌟 [GHOST FORM] ব্যাকগ্রাউন্ডে ডিলিট রিকোয়েস্ট পাঠানোর জন্য এই অদৃশ্য ফর্মটি দরকার --}}
    <form id="delete-user-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

{{-- 🌟 জাভাস্ক্রিপ্ট মেকানিজম অ্যাক্টিভেশন জোন --}}
<script>
    function deleteUser(userId, userName, ordersCount) {
        if (ordersCount > 0) {
            alert("দুঃখিত! '" + userName + "' এর নামে " + ordersCount + " টি অর্ডার সচল আছে। অর্ডার থাকা অবস্থায় কোনো ইউজার ডিলিট করা সম্ভব নয়।");
            return;
        }

        var confirmDelete = confirm("আপনি কি নিশ্চিতভাবে '" + userName + "' কে ডিলিট করতে চান? এই অ্যাকশনটি আর ফেরত আনা যাবে না!");
        
        if (confirmDelete) {
            var form = document.getElementById('delete-user-form');
            form.action = '/admin/users/' + userId + '/delete';
            form.submit();
        }
    }
</script>