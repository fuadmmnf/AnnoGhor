@extends('layouts.admin')

@section('title', 'Delivery Charges Settings')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Delivery Charges Settings</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Delivery Settings</div></li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #c3e6cb;">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #f5c6cb;">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #f5c6cb;">
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row style-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; align-items: start;" id="delivery-section">
                    
                    <div class="wg-box" style="background: #fff; padding: 30px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
                        <div class="flex items-center gap10 mb-20" style="border-bottom: 2px solid #f8fafc; padding-bottom: 12px;">
                            <i class="icon-truck" style="font-size: 20px; color: #f15922;"></i>
                            <h4 style="font-size: 17px; font-weight: 700; color: #1e293b; margin: 0;">Update Logistics Charges</h4>
                        </div>

                        <form action="{{ route('admin.delivery-settings.update') }}" method="POST">
                            @csrf
                            
                            <fieldset class="name" style="margin-bottom: 20px;">
                                <div class="body-title mb-10" style="font-size: 14px; color: #64748b; font-weight: 500;">Inside Dhaka Charge <span class="tf-color-1">*</span></div>
                                <div style="position: relative;">
                                    <span style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-weight: 600;">৳</span>
                                    <input type="number" step="0.01" min="0" placeholder="e.g. 60.00" name="inside_dhaka" 
                                           value="{{ old('inside_dhaka', $deliverySetting->inside_dhaka ?? '') }}" required
                                           style="width: 100%; padding: 14px 20px 14px 35px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 15px; color: #334155; outline: none; box-sizing: border-box;">
                                </div>
                                <div class="text-tiny" style="color: #94a3b8; font-size: 12px; margin-top: 6px;">Set default automated flat rate for deliveries inside Dhaka zone.</div>
                            </fieldset>

                            <fieldset class="name" style="margin-bottom: 25px;">
                                <div class="body-title mb-10" style="font-size: 14px; color: #64748b; font-weight: 500;">Outside Dhaka Charge <span class="tf-color-1">*</span></div>
                                <div style="position: relative;">
                                    <span style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-weight: 600;">৳</span>
                                    <input type="number" step="0.01" min="0" placeholder="e.g. 120.00" name="outside_dhaka" 
                                           value="{{ old('outside_dhaka', $deliverySetting->outside_dhaka ?? '') }}" required
                                           style="width: 100%; padding: 14px 20px 14px 35px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 15px; color: #334155; outline: none; box-sizing: border-box;">
                                </div>
                                <div class="text-tiny" style="color: #94a3b8; font-size: 12px; margin-top: 6px;">Set global flat shipping rate for districts outside Dhaka division.</div>
                            </fieldset>

                            <div class="cols">
                                <button class="tf-button w-full" type="submit" style="background: #f15922; color: #fff; border: none; border-radius: 12px; padding: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s; width: 100%;">
                                    <i class="fas fa-save me-2"></i> Save Logistics Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="wg-box" style="background: #fff; padding: 30px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
                        <div class="flex items-center gap10 mb-20" style="border-bottom: 2px solid #f8fafc; padding-bottom: 12px;">
                            <i class="fas fa-list-alt" style="font-size: 18px; color: #2563eb;"></i>
                            <h4 style="font-size: 17px; font-weight: 700; color: #1e293b; margin: 0;">Live Rates & Overview</h4>
                        </div>

                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <table class="table" style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: left;">
                                <thead>
                                    <tr style="background: #f8fafc; border-bottom: 2px solid #edf2f7;">
                                        <th style="padding: 15px 12px; color: #475569; font-weight: 600;">Location Zone</th>
                                        <th style="padding: 15px 12px; color: #475569; font-weight: 600; text-align: right;">Current Rate</th>
                                        <th style="padding: 15px 12px; color: #475569; font-weight: 600; text-align: center;">Status</th>
                                    </tr>
                                </thead>
                                <tbody style="color: #334155;">
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#fafafa'" onmouseout= "this.style.backgroundColor='transparent'">
                                        <td style="padding: 15px 12px; font-weight: 500;">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i> Inside Dhaka Zone
                                        </td>
                                        <td style="padding: 15px 12px; text-align: right; font-weight: 600; color: #0f172a;">
                                            ৳{{ number_format($deliverySetting->inside_dhaka ?? 0, 2) }}
                                        </td>
                                        <td style="padding: 15px 12px; text-align: center;">
                                            <span style="background: #e6fffa; color: #047481; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block;">Active</span>
                                        </td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#fafafa'" onmouseout= "this.style.backgroundColor='transparent'">
                                        <td style="padding: 15px 12px; font-weight: 500;">
                                            <i class="fas fa-globe-asia text-primary me-2"></i> Outside Dhaka Zone
                                        </td>
                                        <td style="padding: 15px 12px; text-align: right; font-weight: 600; color: #0f172a;">
                                            ৳{{ number_format($deliverySetting->outside_dhaka ?? 0, 2) }}
                                        </td>
                                        <td style="padding: 15px 12px; text-align: center;">
                                            <span style="background: #e6fffa; color: #047481; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block;">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 15px; margin-top: 25px; display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-info-circle" style="color: #16a34a; font-size: 16px; margin-top: 2px;"></i>
                            <p style="margin: 0; font-size: 13px; color: #166534; line-height: 1.4;">
                                <strong>System Note:</strong> These pricing models are fully synchronized with the checkout API. Modifying the values in the form updates the customer's choice live instantly.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection