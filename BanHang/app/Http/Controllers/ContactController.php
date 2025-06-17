<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Hiển thị form liên hệ và danh sách tin nhắn
    public function index()
    {
        // Lấy danh sách tin nhắn của user hiện tại kèm phản hồi từ admin
        $contacts = Contact::where('email', Auth::user()->email)  // hoặc dùng 'user_id' nếu có
            ->with('replies')
            ->latest()
            ->get();

        return view('user.contact', compact('contacts'));
    }

    // Xử lý gửi tin nhắn
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Tin nhắn đã được gửi thành công!');
    }
}
