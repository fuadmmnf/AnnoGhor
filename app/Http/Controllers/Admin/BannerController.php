<?php

namespace App\Http\Controllers\Admin; // Ekhon eta Admin folder-er vitore

use App\Http\Controllers\Controller; // Controller class-ke use korte hobe
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Banner list dekhanor jonno
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    // Create form dekhanor jonno
    public function create()
    {
        $categories = Category::all();
        return view('admin.banners.create', compact('categories'));
    }

    // Store logic
    public function store(Request $request)
{
    // ১. ডাটা আসছে কি না চেক করার জন্য এটি ব্যবহার করে দেখতে পারেন (পরে মুছে দিবেন)
    // dd($request->all()); 

    // ২. ভ্যালিডেশন
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        'type' => 'required|string',
    ]);

    $banner = new \App\Models\Banner(); // সরাসরি মডেল পাথ ব্যবহার করা নিরাপদ

    // ৩. ইমেজ আপলোড লজিক
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('banners', $filename, 'public');
        $banner->image = $path;
    }

    // ৪. বাকি ডাটা এসাইন করা
    $banner->type = $request->type;
    $banner->category_id = $request->category_id;
    $banner->link = $request->link;
    $banner->status = 1; // ডিফল্টভাবে একটিভ থাকবে

    // ৫. ডাটাবেসে সেভ করা
    if($banner->save()) {
        return redirect()->route('admin.banners.index')->with('success', 'Banner added successfully!');
    } else {
        return back()->with('error', 'Something went wrong!');
    }
}
public function destroy($id)
{
    $banner = \App\Models\Banner::findOrFail($id);
    
    // ফোল্ডার থেকে ফাইল ডিলিট করা
    if ($banner->image) {
        \Storage::disk('public')->delete($banner->image);
    }
    
    $banner->delete();

    return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
}
}