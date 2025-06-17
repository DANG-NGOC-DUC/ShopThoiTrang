<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact; 
use App\Models\ContactReply;

class NotificationController extends Controller
{
    // Hiển thị trang thông báo với danh sách liên hệ và phản hồi
    public function index()
    {
        // Đánh dấu toàn bộ liên hệ là đã đọc
        Contact::where('is_read', false)->update(['is_read' => true]);

        // Lấy các liên hệ mới nhất và nạp sẵn phản hồi
        $contacts = Contact::with('replies')->latest()->get();

        // Trả về view
        return view('admin.notification', compact('contacts'));
    }

    // Lưu phản hồi từ admin
    public function storeReply(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'reply' => 'required|string',
        ]);

        ContactReply::create([
            'contact_id' => $request->contact_id,
            'replied_by_user_id' => Auth::id(), // Gắn ID người trả lời
            'reply' => $request->reply,
        ]);

        return redirect()->back()->with('success', 'Đã gửi phản hồi!');
    }
}
