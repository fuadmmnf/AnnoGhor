@extends('layouts.admin')

@section('title', 'Add FAQ')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            {{-- Header --}}
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add FAQ</h3>
                <ul class="breadcrumbs flex items-center gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.faqs.index') }}">
                            <div class="text-tiny">FAQ</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Add FAQ</div></li>
                </ul>
            </div>

            {{-- Alerts --}}
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.faqs.store') }}" method="POST" class="tf-section-2">
                @csrf

                <div class="wg-box">

                    <fieldset>
                        <div class="body-title mb-10">Question <span class="tf-color-1">*</span></div>
                        <input type="text" name="question" value="{{ old('question') }}"
                               placeholder="Enter FAQ question" required>
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Answer <span class="tf-color-1">*</span></div>
                        <textarea name="answer" rows="6" placeholder="Enter answer" required>{{ old('answer') }}</textarea>
                    </fieldset>

                    <div class="gap22 cols">
                        <fieldset>
                            <div class="body-title mb-10">Display Order (Rank)</div>
                            <input type="number" min="1" name="rank" value="{{ old('rank', 1) }}">
                            <div class="text-tiny">Lower number shows first</div>
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10">Status</div>
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_active" value="1"
                                       {{ old('is_active', 1) ? 'checked' : '' }}>
                                <label class="body-text">Active (Visible)</label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="cols gap10 mt-20">
                        <button type="submit" class="tf-button w-full">Save FAQ</button>
                        <a href="{{ route('admin.faqs.index') }}" class="tf-button style-2 w-full">Cancel</a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
