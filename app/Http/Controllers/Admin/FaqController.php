<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('rank', 'asc')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.add-faq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'rank' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['question', 'answer', 'rank']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Faq::create($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ added successfully!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit-faq', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'rank' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['question', 'answer', 'rank']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $faq->update($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully!');
    }

    public function toggleStatus(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);
        
        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ status updated successfully!');
    }
}