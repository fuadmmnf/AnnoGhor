<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.review-list', compact('reviews'));
    }

    public function create()
    {
        return view('admin.add-review');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['reviewer_name', 'review_text', 'rating']);
          $data['is_active'] = $request->has('is_active') ? 1 : 0;


        if ($request->hasFile('reviewer_image')) {
            $image = $request->file('reviewer_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/testimonial'), $imageName);
            $data['reviewer_image'] = $imageName;
        }

        Review::create($data);

        return redirect()->route('admin.review-list')
            ->with('success', 'Review added successfully!');
    }

    public function edit(Review $review)
    {
        return view('admin.edit-review', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review_text' => 'required|string',
            'reviewer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['reviewer_name', 'review_text', 'rating']);
          $data['is_active'] = $request->has('is_active') ? 1 : 0;
          
        if ($request->hasFile('reviewer_image')) {
            // Delete old image
            if ($review->reviewer_image && file_exists(public_path('assets/images/testimonial/' . $review->reviewer_image))) {
                unlink(public_path('assets/images/testimonial/' . $review->reviewer_image));
            }

            $image = $request->file('reviewer_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/testimonial'), $imageName);
            $data['reviewer_image'] = $imageName;
        }

        $review->update($data);

        return redirect()->route('admin.review-list')
            ->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        // Delete image if exists
        if ($review->reviewer_image && file_exists(public_path('assets/images/testimonial/' . $review->reviewer_image))) {
            unlink(public_path('assets/images/testimonial/' . $review->reviewer_image));
        }

        $review->delete();

        return redirect()->route('admin.review-list')
            ->with('success', 'Review deleted successfully!');
    }

    public function toggleStatus(Review $review)
    {
        $review->update(['is_active' => !$review->is_active]);
        
        return redirect()->route('admin.review-list')
            ->with('success', 'Review status updated successfully!');
    }
}