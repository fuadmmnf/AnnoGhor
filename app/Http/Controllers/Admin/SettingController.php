<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
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
// Social links page show korbe
public function socialLinks()
{
    $setting = Setting::first();
    return view('admin.settings.social_links', compact('setting'));
}

// Social links update korbe
public function updateSocialLinks(Request $request)
{
    $request->validate([
        'facebook_url'  => 'nullable|url',
        'instagram_url' => 'nullable|url',
        'linkedin_url'  => 'nullable|url',
        'twitter_url'   => 'nullable|url',
    ]);

    $setting = Setting::first();
    
    // সব ডাটা একসাথে আপডেট করুন
    $setting->update([
        'facebook_url'  => $request->facebook_url,
        'instagram_url' => $request->instagram_url,
        'linkedin_url'  => $request->linkedin_url,
        'twitter_url'   => $request->twitter_url,
    ]);

    return redirect()->back()->with('success', 'Social media links updated successfully!');
}
}