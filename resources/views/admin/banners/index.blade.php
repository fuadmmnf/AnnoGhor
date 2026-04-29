@extends('layouts.admin')

@section('title', 'All Banners')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>All Banners</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Banners</div>
                        </li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success"
                        style="padding: 15px; background: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap mb-24">
                        <div class="body-title">Banner List</div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.banners.create') }}">
                            <i class="icon-plus"></i>Add New Banner
                        </a>
                    </div>

                    @if ($banners->isEmpty())
                        <div class="text-center py-8">
                            <div class="body-title mb-3">No banners found.</div>
                        </div>
                    @else
                        <div class="product-table-wrapper">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th style="width: 150px;">Image</th>
                                        <th>Type</th>
                                        <th>Link/Category</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>
                                                <div class="product-image" style="width: 120px; height: 60px;">
                                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                            </td>
                                            <td><span class="category-badge">{{ ucfirst($banner->type) }}</span></td>
                                            <td>
                                                <span class="body-text">
                                                    {{ $banner->category_id ? 'Category: ' . $banner->category->name : $banner->link ?? 'No Link' }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <span
                                                    class="stock-badge in-stock">{{ $banner->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td style="text-align: center;">
                                                <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger" style="font-size: 20px;"><i
                                                            class="icon-trash-2"></i></button>
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
