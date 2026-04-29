<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // যখন message দেখবে তখন automatically read হয়ে যাবে
        if (!$message->is_read) {
            $message->markAsRead();
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();
        
        return redirect()->back()->with('success', 'Message marked as read!');
    }

    public function markAsUnread($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsUnread();
        
        return redirect()->back()->with('success', 'Message marked as unread!');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return redirect()->back()->with('success', 'Message deleted successfully!');
    }

    public function getUnreadMessages()
    {
        $messages = ContactMessage::unread()->latest()->take(5)->get();
        $unreadCount = ContactMessage::getUnreadCount();
        
        return response()->json([
            'messages' => $messages,
            'unreadCount' => $unreadCount
        ]);
    }
}