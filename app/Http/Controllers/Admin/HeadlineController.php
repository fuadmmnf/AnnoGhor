<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
public function index() {
    $headlines = Headline::latest()->get(); // Headline model import kora thakte hobe
    return view('admin.headlines.index', compact('headlines'));
}

    public function store(Request $request) {
        $request->validate(['title' => 'required']);
        Headline::create($request->all());
        return back()->with('success', 'Headline added successfully!');
    }

    // এডিট করার জন্য ডাটা নিয়ে আসা
public function edit($id) {
    $headline = Headline::findOrFail($id);
    $headlines = Headline::latest()->get(); // ইন্ডেক্স পেজেই এডিট ফর্ম দেখানোর জন্য
    return view('admin.headlines.index', compact('headline', 'headlines'));
}

// আপডেট করার লজিক
public function update(Request $request, $id) {
    $request->validate(['title' => 'required|string|max:255']);
    $headline = Headline::findOrFail($id);
    $headline->update(['title' => $request->title]);
    
    return redirect()->route('admin.headlines.index')->with('success', 'Headline updated successfully!');
}
    public function destroy($id) {
        Headline::findOrFail($id)->delete();
        return back()->with('success', 'Headline deleted!');
    }
}