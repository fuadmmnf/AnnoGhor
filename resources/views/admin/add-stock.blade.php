@extends('layouts.admin')

@section('title', 'Add Product Stock')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Stock Management</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <a href="{{ route('admin.product-list') }}">
                                <div class="text-tiny">Products</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Add Stock</div>
                        </li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4"
                        style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4"
                        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="wg-box">
                    <form action="{{ route('admin.stock.store') }}" method="POST" class="form-new-product form-style-1">
                        @csrf

                        <div class="gap22 cols">
                            {{-- Category Selection --}}
                            <fieldset class="category">
                                <div class="body-title">Category <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select id="category_id" name="category_id" required>
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>

                            {{-- Subcategory Selection --}}
                            <fieldset class="subcategory">
                                <div class="body-title">Subcategory <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select id="subcategory_id" name="subcategory_id" required>
                                        <option value="">Choose Subcategory</option>
                                    </select>
                                </div>
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            {{-- Product Selection --}}
                            <fieldset class="product-name">
                                <div class="body-title">Select Product <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select id="product_id" name="product_id" required>
                                        <option value="">Choose Product</option>
                                    </select>
                                </div>
                            </fieldset>

                            {{-- Stock Quantity Input --}}
                            <fieldset class="stock-amount">
                                <div class="body-title">New Stock Amount <span class="tf-color-1">*</span></div>
                                <input type="number" name="stock_quantity" placeholder="Enter amount to add" tabindex="0"
                                    value="{{ old('stock_quantity') }}" aria-required="true" required min="1">
                            </fieldset>
                        </div>

                        <div class="bot">
                            <div></div>
                            <button class="tf-button w208" type="submit">Update Stock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Annoghor. All rights reserved. Designed and Developed </div>
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>

    {{-- jQuery and AJAX with Custom Nice-Select Refresh Sync --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            
            // ১. ক্যাটাগরি পরিবর্তন হলে সাব-ক্যাটাগরি লোড করার মেকানিজম
            $('#category_id').on('change', function() {
                var categoryId = $(this).val();
                
                $('#subcategory_id').html('<option value="">Loading...</option>');
                $('#product_id').html('<option value="">Choose Product</option>');
                
                // থিম যদি nice-select প্লাগইন ব্যবহার করে তবে সেটিকে লাইভ আপডেট করার ট্রিগার
                if($.fn.niceSelect) {
                    $('#subcategory_id').niceSelect('update');
                    $('#product_id').niceSelect('update');
                }

                if (categoryId) {
                    $.ajax({
                        url: '/admin/categories/' + categoryId + '/subcategories',
                        type: "GET",
                        success: function(data) {
                            $('#subcategory_id').html('<option value="">Choose Subcategory</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            
                            // এজ্যাক্স ডাটা ইনজেকশনের পর nice-select রিফ্রেশ
                            if($.fn.niceSelect) {
                                $('#subcategory_id').niceSelect('update');
                            }
                        },
                        error: function() {
                            $('#subcategory_id').html('<option value="">Choose Subcategory</option>');
                            if($.fn.niceSelect) $('#subcategory_id').niceSelect('update');
                        }
                    });
                } else {
                    $('#subcategory_id').html('<option value="">Choose Subcategory</option>');
                    if($.fn.niceSelect) $('#subcategory_id').niceSelect('update');
                }
            });

            // ২. সাব-ক্যাটাগরি পরিবর্তন হলে প্রোডাক্ট লোড করার ফিক্সড মেকানিজম
            $('#subcategory_id').on('change', function() {
                var subcategoryId = $(this).val();
                
                $('#product_id').html('<option value="">Loading...</option>');
                if($.fn.niceSelect) {
                    $('#product_id').niceSelect('update');
                }

                if (subcategoryId) {
                    $.ajax({
                        url: '/admin/subcategories/' + subcategoryId + '/products',
                        type: "GET",
                        success: function(data) {
                            $('#product_id').html('<option value="">Choose Product</option>');
                            $.each(data, function(key, value) {
                                var stockText = value.stock_quantity !== null ? ' (Stock: ' + value.stock_quantity + ')' : ' (Stock: 0)';
                                $('#product_id').append('<option value="' + value.id + '">' + value.name + stockText + '</option>');
                            });
                            
                            // 🔥 ম্যাজিক লাইন: ডাটা আসার পর nice-select প্লাগইনকে আপডেট সিগন্যাল পাঠানো হলো
                            if($.fn.niceSelect) {
                                $('#product_id').niceSelect('update');
                            }
                        },
                        error: function() {
                            $('#product_id').html('<option value="">Choose Product</option>');
                            if($.fn.niceSelect) $('#product_id').niceSelect('update');
                        }
                    });
                } else {
                    $('#product_id').html('<option value="">Choose Product</option>');
                    if($.fn.niceSelect) $('#product_id').niceSelect('update');
                }
            });
        });
    </script>
@endsection