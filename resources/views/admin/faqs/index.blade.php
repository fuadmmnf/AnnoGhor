@extends('layouts.admin')

@section('title', 'FAQ List')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>FAQ List</h3>

                <ul class="breadcrumbs flex items-center gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">FAQ</div></li>
                </ul>

                <a href="{{ route('admin.faqs.add-faq') }}" class="tf-button">
                    <i class="icon-plus"></i> Add FAQ
                </a>
            </div>

            {{-- @include('partials.alerts') Optional: If you use a partial --}}
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="wg-box">
    @if($faqs->isEmpty())
        <div class="text-center py-8">
            <div class="body-title mb-3">No FAQs found</div>
            <a class="tf-button style-1" href="{{ route('admin.faqs.add-faq') }}">
                <i class="icon-plus"></i> Add FAQ
            </a>
        </div>
    @else
        <div class="text-tiny mb-2 d-md-none" style="color: #888; font-style: italic; display: block;">
            <i class="icon-arrow-left"></i> Scroll left/right to view full table <i class="icon-arrow-right"></i>
        </div>
        
        <div class="product-table-wrapper">
            <table class="product-table">
                <thead>
                    <tr>
                        <th width="10%">Rank</th>
                        <th width="30%">Question</th>
                        <th width="40%">Answer</th>
                        <th width="20%">Status</th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td><span class="badge bg-primary">{{ $faq->rank }}</span></td>
                            <td><strong>{{ $faq->question }}</strong></td>
                            <td>{{ \Illuminate\Support\Str::limit($faq->answer, 120) }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action {{ $faq->is_active ? 'edit' : 'delete' }}">
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
    <div class="flex gap10 justify-center items-center">
        <a href="{{ route('admin.faqs.edit-faq', $faq) }}" class="tf-button btn-sm">
            <i class="icon-edit"></i>
        </a>
        <form action="{{ route('admin.faqs.delete', $faq) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="tf-button style-2 btn-sm bg-danger">
                <i class="icon-trash"></i>
            </button>
        </form>
    </div>
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between flex-wrap gap10 mt-3">
            <div class="text-tiny">
                Showing {{ $faqs->firstItem() ?? 0 }} to {{ $faqs->lastItem() ?? 0 }} 
                of {{ $faqs->total() }} entries
            </div>
            {{ $faqs->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
        </div>
    </div>
</div>

<style>
/* Table Wrapper - Main Responsive Secret */
.product-table-wrapper {
    width: 100%;
    overflow-x: auto; /* Mobile e side scroll hobe */
    -webkit-overflow-scrolling: touch;
    margin: 20px 0;
    border-radius: 8px;
    border: 1px solid #eee;
}

.product-table {
    width: 100%;
    min-width: 700px; /* Mobile e table jate ekbare choto na hoye jay, tai min-width */
    border-collapse: collapse;
    background: white;
}

/* Header styling */
.product-table thead tr {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.product-table th, .product-table td {
    padding: 12px 15px;
    font-size: 14px;
    color: #333;
    text-align: left;
    white-space: nowrap; /* Text jate niche neme na jay, table row soja thakbe */
}

/* Actions alignment fix */
.product-table td.flex {
    display: flex;
    align-items: center; /* Vertical alignment center korbe */
    justify-content: center; /* Horizontal alignment center korbe */
    height: 100%;
    min-height: 50px; /* Cell height er sathe samonjossho rakhar jonno */
    border-bottom: none; /* Cell er vitorer extra border thakle seta remove korbe */
}

/* Table cell vertical alignment */
.product-table td {
    vertical-align: middle; /* Sob column er data jate majhkane thake */
}
/* Question & Answer width control */
.product-table td:nth-child(2) { /* Question column */
    white-space: normal; /* Question column e text wrap hobe */
    min-width: 200px;
}
.product-table td:nth-child(3) { /* Answer column */
    white-space: normal; /* Answer column e text wrap hobe */
    min-width: 300px;
}

/* Row hover */
.product-table tbody tr:hover {
    background: #fdfdfd;
}

/* Action Buttons */
.btn-action {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    text-transform: uppercase;
}

.btn-action.edit { background-color: #28a745; color: #fff; }
.btn-action.delete { background-color: #6c757d; color: #fff; }

/* Mobile Optimization for Header & Search */
@media (max-width: 576px) {
    .flex.items-center.justify-between {
        flex-direction: column; /* Mobile e Header element gulo ekta niche arekta thakbe */
        align-items: flex-start !important;
        gap: 15px;
    }
    
    .tf-button {
        width: 100%; /* Add button mobile e full width hobe */
        justify-content: center;
    }
    
    .breadcrumbs {
        margin-bottom: 10px;
    }
}
</style>
@endsection