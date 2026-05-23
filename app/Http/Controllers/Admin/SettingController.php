<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\DeliverySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * জেনারেল সেটিংসের পেজ দেখাবে (resources/views/admin/settings/index.blade.php)
     */
    public function index()
    {
        $setting = Setting::first();
        
        // যদি setting না থাকে তাহলে নতুন create করবে
        if (!$setting) {
            $setting = Setting::create([
                'site_phone' => '',
                'site_email' => '',
                'site_address' => '',
            ]);
        }
        
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * জেনারেল সেটিংস আপডেট করবে
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_phone'   => 'required|string|max:20',
            'site_email'   => 'required|email|max:100',
            'site_address' => 'required|string',
            'site_logo'    => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $setting = Setting::first();
        $data = $request->only(['site_phone', 'site_email', 'site_address']);

        // লোগো আপলোড হ্যান্ডেল করা
        if ($request->hasFile('site_logo')) {
            // পুরোনো লোগো ডিলিট করা
            if ($setting && $setting->site_logo) {
                $oldPath = public_path('uploads/settings/' . $setting->site_logo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $image = $request->file('site_logo');
            $name = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            $data['site_logo'] = $name;
        }

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->back()->with('success', 'General settings updated successfully!');
    }

    /**
     * সোশ্যাল লিংক পেজ শো করবে
     */
    public function socialLinks()
    {
        $setting = Setting::first();
        return view('admin.settings.social_links', compact('setting'));
    }

    /**
     * সোশ্যাল লিংক আপডেট করবে
     */
    public function updateSocialLinks(Request $request)
    {
        $request->validate([
            'facebook_url'  => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url'  => 'nullable|url',
            'twitter_url'   => 'nullable|url',
        ]);

        $setting = Setting::first();
        
        $setting->update([
            'facebook_url'  => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'linkedin_url'  => $request->linkedin_url,
            'twitter_url'   => $request->twitter_url,
        ]);

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }

    /**
     * 🚚 নতুন বাতি মেথড: ডেলিভারি চার্জের আলাদা পেজ ভিউ করবে (resources/views/admin/settings/charge.blade.php)
     */
    public function charge() 
    {
        // ডেলিভারি চার্জের প্রথম রো-টি ডেটাবেজ থেকে তুলে আনা
        $deliverySetting = DeliverySetting::first();
        
        // যদি ডাটাবেজে কোনো রো না থাকে, তবে একটি ডিফল্ট রো তৈরি করে নেবে যাতে ব্লেডে এরর না আসে
        if (!$deliverySetting) {
            $deliverySetting = DeliverySetting::create([
                'inside_dhaka'  => 60.00,
                'outside_dhaka' => 120.00,
            ]);
        }

        // আপনার কাঙ্খিত আলাদা ব্লেড ফাইল 'charge.blade.php' লোড করা হলো
        return view('admin.settings.charge', compact('deliverySetting'));
    }

    /**
     * 🚚 নতুন বাতি মেথড: আলাদাভাবে শুধুমাত্র ডেলিভারি চার্জ ডাটা সেভ/আপডেট করবে
     */
    public function updateDeliveryCharge(Request $request)
    {
        $request->validate([
            'inside_dhaka'  => 'required|numeric|min:0',
            'outside_dhaka' => 'required|numeric|min:0',
        ]);

        try {
            $deliverySetting = DeliverySetting::first();

            if (!$deliverySetting) {
                $deliverySetting = new DeliverySetting();
            }

            $deliverySetting->inside_dhaka  = $request->inside_dhaka;
            $deliverySetting->outside_dhaka = $request->outside_dhaka;
            $deliverySetting->save();

            return redirect()->back()->with('success', 'Delivery charges updated successfully!');

        } catch (\Exception $e) {
            Log::error('Delivery Charge Update Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update delivery charges. Please try again.');
        }
    }
}