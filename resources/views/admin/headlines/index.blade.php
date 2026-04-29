@extends('layouts.admin')

@section('title', 'Manage Headlines')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Manage Headlines</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Headlines</div></li>
                </ul>
            </div>

 @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="wg-box mb-30">
    <form action="{{ isset($headline) ? route('admin.headline.update', $headline->id) : route('admin.headline.store') }}" method="POST">
        @csrf
        @if(isset($headline))
            @method('PUT')
        @endif

        <div class="flex gap20 items-center">
            <div style="flex-grow: 1;">
                <input type="text" name="title" class="form-control" 
                       value="{{ $headline->title ?? old('title') }}" 
                       placeholder="Enter headline text (e.g. New Winter Collection 2026)" required>
            </div>
            
            <button type="submit" class="tf-button style-1 w200">
                <i class="icon-{{ isset($headline) ? 'check' : 'plus' }}"></i> 
                {{ isset($headline) ? 'Update Headline' : 'Add Headline' }}
            </button>

            @if(isset($headline))
                <a href="{{ route('admin.headlines.index') }}" class="btn btn-secondary">Cancel</a>
            @endif
        </div>
    </form>
</div>

<div class="wg-box">
    <div class="title-box mb-4">
        <div class="body-title">Active Marquee Headlines</div>
    </div>

    @if($headlines->isEmpty())
        <div class="text-center py-8">
            <div class="body-title mb-3">No headlines found</div>
        </div>
    @else
        <div class="product-table-wrapper">
            <table class="product-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">SL</th>
                        <th style="width: 60%;">Headline Text</th>
                        <th style="width: 30%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($headlines as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><div class="body-title-2">{{ $item->title }}</div></td>
                            <td style="text-align: center;">
                                <div class="action-buttons" style="display: flex; gap: 10px; justify-content: center;">
                                    <a href="{{ route('admin.headline.edit', $item->id) }}" class="btn-action edit" title="Edit" style="background: #e6f7ff; color: #1890ff; border: 1px solid #91d5ff; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="icon-edit-3"></i>
                                    </a>

                                    <form action="{{ route('admin.headline.delete', $item->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this headline?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Delete" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
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
    @endif
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

<style>
/* Apnar Review list er style gulo ekhane apply hobe */
.product-table-wrapper {
    overflow-x: auto;
    margin: 10px 0;
}
.product-table {
    width: 100%;
    border-collapse: collapse;
}
.product-table thead tr {
    background: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}
.product-table th, .product-table td {
    padding: 15px 10px;
    font-size: 14px;
    color: #333;
    text-align: left;
}
.product-table tbody tr {
    border-bottom: 1px solid #eee;
}
.product-table tbody tr:hover {
    background: #fbfbfb;
}

/* Form Styling to match your theme */
.form-control {
    width: 100%;
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}
.btn-action {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-action.delete {
    background-color: #fff1f0;
    color: #ff4d4f;
    border: 1px solid #ffa39e;
}
.btn-action.delete:hover {
    background-color: #ff4d4f;
    color: #fff;
}

/* Alert Styling */
.alert-success {
    padding: 15px;
    background-color: #f6ffed;
    border: 1px solid #b7eb8f;
    color: #389e0d;
    border-radius: 8px;
}
</style>
@endsection