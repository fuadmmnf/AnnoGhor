<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('contact', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ];

    // ডাটাবেসে সেভ
    ContactMessage::create($data);

    // মেইল পাঠানো (এখানে আপনার নিজের ইমেইল এড্রেস দিন যেখানে আপনি মেসেজটি পেতে চান)
    try {
        Mail::to('shkaisar2002@gmail.com')->send(new ContactMail($data));
    } catch (\Exception $e) {
        //\Log::error("Mail Error: " . $e->getMessage());
        // মেইল না গেলেও ডাটাবেসে সেভ হবে, আপনি চাইলে লগ চেক করতে পারেন
    }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}