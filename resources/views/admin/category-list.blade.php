@extends('layouts.admin')

@section('title', 'Category List')

@section('content')
    <style>

        /* Search Form Container */
    .form-search {
        position: relative;
        width: 100%;
        max-width: 300px;
    }

    /* Input Box Styling */
    .form-search input[type="text"] {
        width: 100%;
        padding: 10px 40px 10px 15px; /* Right side e 40px faka rakha hoyeche icon er jonno */
        border: 1px solid #000000 !important; /* Pure Black Border */
        border-radius: 6px;
        outline: none;
        color: #000;
        background: #fff;
    }

    /* Search Button (Positioned inside) */
    .form-search .button-submit {
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-search .button-submit button {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .form-search .button-submit i {
        font-size: 18px;
        color: #000; /* Icon color black */
    }
    
    /* Input focus korle jeno border black e thake */
    .form-search input[type="text"]:focus {
        border: 1.5px solid #000 !important;
    }
        /* Table Container - Screen size e fit korar jonno */
        .wg-table {
            width: 100%;
            overflow: hidden;
        }

        /* Column Width Calculation (Screen e fit korar logic) */
        .col-name { flex: 2; min-width: 150px; } 
        .col-sub  { flex: 3; min-width: 200px; } 
        .col-qty  { flex: 1; min-width: 80px; text-align: center; }
        .col-sale { flex: 1; min-width: 70px; text-align: center; }
        .col-action { flex: 1; min-width: 100px; display: flex; justify-content: flex-end; }

        /* Row structure */
        .table-row-wrapper {
            display: flex;
            width: 100%;
            align-items: flex-start;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            gap: 10px;
        }

        .table-header {
            background: #f8f9fa;
            font-weight: 700;
            font-size:18px;
            color: #333;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        /* Text and Color */
        .text-black { color: #000000 !important; font-size: 14px; }
        .sub-text {
            display: block;
            font-size: 16px;
            color: #000 !important;
            margin-bottom: 2px;
            line-height: 1.4;
        }

        /* Icons */
        .list-icon-function {
            display: flex !important;
            gap: 5px;
        }
        .list-icon-function .item {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }
        .item.edit { background: #dbeafe; color: #2563eb; }
        .item.trash { background: #fee2e2; color: #dc2626; border: none; cursor: pointer; }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center justify-between gap20 mb-27">
                    <h3>All Category</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Category List</div></li>
                    </ul>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap mb-20">
                        <div class="wg-filter flex-grow flex items-center gap20">
                            <div class="show flex items-center gap10">
                                <div class="text-tiny">Showing</div>
                                <div class="select">
                                    <select name="per_page" onchange="this.form.submit()" form="searchForm">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                    </select>
                                </div>
                                <div class="text-tiny">entries</div>
                            </div>
                            
                       <form id="searchForm" method="GET" action="{{ route('admin.category-list') }}" class="form-search">
    <input type="text" placeholder="Search categories..." name="name" value="{{ request('name') }}">
    <div class="button-submit">
        <button type="submit">
            <i class="icon-search"></i>
        </button>
    </div>
</form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.add-category') }}">
                            <i class="icon-plus"></i>Add new
                        </a>
                    </div>

                    <div class="wg-table">
                        <div class="table-row-wrapper table-header">
                            <div class="col-name">Category</div>
                            <div class="col-sub">Subcategories</div>
                            <div class="col-qty" style="width:50%;"> Quantity</div>
                            <div class="col-sale" style="width:50%;"> Sold</div>
                             <div class="col-sale" style="width:50%;"> Total Sale</div>
                            <div class="col-action">Action</div>
                        </div>

                        @forelse($categories as $category)
                        <div class="table-row-wrapper">
                            <div class="col-name">
                                <span class="text-black" style="font-weight: 600; font-size: 16px;">{{ $category->name }}</span>
                            </div>

                            <div class="col-sub">
                                @foreach($category->subcategories as $subcategory)
                                    <span class="sub-text">• {{ $subcategory->name }}</span>
                                @endforeach
                                @if($category->subcategories->isEmpty())
                                    <span class="text-muted" style="font-size: 12px;">No subcategories</span>
                                @endif
                            </div>

                            <div class="col-qty text-black">{{ $category->products_count }}</div>
             <div class="col-qty text-black">
    {{ $category->total_sold_quantity ?? 0 }}
</div>

<div class="col-sale text-black">
    {{ number_format($category->total_sale_amount ?? 0, 2) }}
</div>
                            <div class="col-action">
                                <div class="list-icon-function">
                                    <a href="{{ route('admin.edit-category', $category->id) }}" class="item edit">
                                        <i class="icon-edit-3" style="font-size: 14px;"></i>
                                    </a>
                                    <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item trash">
                                            <i class="icon-trash-2" style="font-size: 14px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <p class="body-text">No categories found matching your search.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="divider"></div>
                    
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries</div>
                        
                        <div class="wg-pagination">
                            {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Earth Craft. All
                rights
                reserved. Designed and Developed </div>
            {{-- <i class="icon-heart"></i> --}}
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>
@endsection