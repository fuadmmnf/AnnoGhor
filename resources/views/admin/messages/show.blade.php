@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Message Details</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><a href="{{ route('admin.messages.index') }}"><div class="text-tiny">Messages</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">View</div></li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between mb-20">
                    <a href="{{ route('admin.messages.index') }}" class="tf-button style-1">
                        <i class="icon-arrow-left"></i> Back to List
                    </a>
                    <div>
                        @if($message->is_read)
                            <span class="status-badge status-read">Read</span>
                        @else
                            <span class="status-badge status-unread">Unread</span>
                        @endif
                    </div>
                </div>

                <div class="divider mb-20"></div>

                <div class="message-info-grid">
                    <div class="info-item">
                        <label>Customer Name</label>
                        <div class="info-value">{{ $message->name }}</div>
                    </div>
                    
                    <div class="info-item">
                        <label>Email Address</label>
                        <div class="info-value">
                            <a href="mailto:{{ $message->email }}" class="text-primary">{{ $message->email }}</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <label>Received Date</label>
                        <div class="info-value text-muted">{{ $message->created_at->format('d M, Y - h:i A') }}</div>
                    </div>
                </div>

                <div class="message-content-box mt-20">
                    <label class="mb-10 block font-bold">Message Text:</label>
                    <div class="content-body">
                        {{ $message->message }}
                    </div>
                </div>

                <div class="divider mt-20 mb-20"></div>

                <div class="flex items-center flex-wrap gap10">
                    <form action="{{ route('admin.messages.' . ($message->is_read ? 'mark-unread' : 'mark-read'), $message->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-action-large {{ $message->is_read ? 'bg-secondary' : 'bg-success' }}">
                            <i class="{{ $message->is_read ? 'icon-mail' : 'icon-check' }}"></i>
                            {{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}
                        </button>
                    </form>

                    <a href="mailto:{{ $message->email }}" class="btn-action-large bg-info">
                        <i class="icon-send"></i> Reply via Email
                    </a>

                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action-large bg-danger">
                            <i class="icon-trash-2"></i> Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Status Badge styling matching previous table */
    .status-badge {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        display: inline-block;
    }
    .status-read { background: #d4edda; color: #155724; }
    .status-unread { background: #fff3cd; color: #856404; }

    /* Info Grid Layout */
    .message-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    .info-item label {
        display: block;
        font-size: 13px;
        color: #777;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 18px; /* Boro text */
        font-weight: 600;
        color: #222;
    }

    /* Message Content Box */
    .message-content-box .content-body {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #eee;
        line-height: 1.8;
        font-size: 17px;
        color: #444;
        white-space: pre-line; /* Message line break thik rakhe */
    }

    /* Action Buttons styling */
    .btn-action-large {
        padding: 12px 20px;
        border-radius: 8px;
        color: #fff;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 500;
        transition: 0.3s;
    }
    .btn-action-large:hover { opacity: 0.9; transform: translateY(-1px); }
    
    .bg-success { background-color: #28a745; }
    .bg-secondary { background-color: #6c757d; }
    .bg-info { background-color: #17a2b8; }
    .bg-danger { background-color: #dc3545; }

    /* Divider */
    .divider { height: 1px; background: #eee; width: 100%; }
</style>
@endsection