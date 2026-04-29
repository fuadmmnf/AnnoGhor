@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<style>
    /* 1. Mobile & Global Container Fix */
    .main-content {
        overflow-y: auto !important;
        height: 100vh;
    }

    .wg-box {
        padding: 15px !important; /* Mobile e kom padding */
        border-radius: 12px;
        background: #fff;
        overflow: hidden !important; /* Bahire jate na jay */
    }
    
    @media (min-width: 768px) {
        .wg-box { padding: 30px !important; }
    }

    /* 2. Squeeze Problem Fix (The Table Wrapper) */
    .product-table-wrapper {
        width: 100%;
        overflow-x: auto; /* Force horizontal scroll */
        -webkit-overflow-scrolling: touch; /* Smooth scroll for mobile */
        border: 1px solid #f0f0f0;
        border-radius: 8px;
        margin-top: 20px;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px; /* ETIAI MAIN FIX: Table k boro rakha jate squeeze na hoy */
    }

    .product-table th {
        background: #fdfdfd;
        padding: 15px;
        font-size: 15px;
        font-weight: 700;
        color: #333;
        border-bottom: 2px solid #eee;
        text-align: left;
    }

    .product-table td {
        padding: 15px;
        font-size: 16px; 
        color: #444;
        vertical-align: middle;
        border-bottom: 1px solid #f7f7f7;
    }

    /* Unread highlighting */
    .unread-row { background-color: #f0f7ff !important; }

    /* 3. Button & Badge Styles */
    .btn-status {
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid transparent;
        cursor: pointer;
        display: inline-block;
        white-space: nowrap; /* Button jate bhenge na jay */
    }
    .status-read { background: #e6fcf5; color: #0ca678; border-color: #c3fae8; }
    .status-unread { background: #fff4e6; color: #f76707; border-color: #ffe8cc; }

    .action-buttons { display: flex; gap: 8px; }
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: 0.2s;
    }
    .btn-action.view { background: #e7f5ff; color: #228be6; }
    .btn-action.delete { background: #fff5f5; color: #fa5252; }

    /* 4. Pagination Responsive Fix */
    .pagin-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3 style="font-weight: 700; font-size: 24px;">Contact Messages</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny" style="color: #999;">Messages</div></li>
                </ul>
            </div>

            <div class="wg-box">
                @if($messages->isEmpty())
                    <div class="text-center py-5">
                        <p style="color: #999; font-size: 18px;">Inbox is empty.</p>
                    </div>
                @else
                    <div class="product-table-wrapper">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th style="width: 180px;">Name</th>
                                    <th style="width: 220px;">Email</th>
                                    <th>Message Preview</th>
                                    <th style="width: 120px; text-align: center;">Status</th>
                                    <th style="width: 130px;">Date</th>
                                    <th style="width: 110px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $index => $message)
                                    <tr class="{{ !$message->is_read ? 'unread-row' : '' }}">
                                        <td>{{ $messages->firstItem() + $index }}</td>
                                        <td><strong>{{ $message->name }}</strong></td>
                                        <td>{{ $message->email }}</td>
                                        <td>
                                            <div style="max-width: 400px; line-height: 1.4;">
                                                {{ Str::limit($message->message, 90) }}
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('admin.messages.' . ($message->is_read ? 'mark-unread' : 'mark-read'), $message->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-status {{ $message->is_read ? 'status-read' : 'status-unread' }}">
                                                    {{ $message->is_read ? 'Read' : 'Unread' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td style="white-space: nowrap;">{{ $message->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-action view" title="View">
                                                    <i class="icon-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action delete" title="Delete"
                                                            onclick="if(confirm('Delete this message?')) this.form.submit();">
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
                    <div class="pagin-wrap">
                        <div style="font-size: 15px; color: #777;">
                            Showing <strong>{{ $messages->firstItem() }}</strong> to <strong>{{ $messages->lastItem() }}</strong> 
                            of <strong>{{ $messages->total() }}</strong>
                        </div>
                        <div>
                            {{ $messages->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection