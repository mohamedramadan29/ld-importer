<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\ContactMessage;
use App\Http\Traits\Message_Trait;

class ContactMessageController extends Controller
{
    use Message_Trait;

    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('dashboard.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => 1]);
        return view('dashboard.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return $this->success_message('تم حذف الرسالة بنجاح');
    }

    public function markRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => 1]);
        return $this->success_message('تم تحديد الرسالة كمقروءة');
    }
}
