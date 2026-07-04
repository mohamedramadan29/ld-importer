<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\ContactMessage;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index() {
        return view('front.index');
    }

    public function about() {
        return view('front.about');
    }

    public function contact(){
        return view('front.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'country' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($validated);

        $adminEmail = 'info@ldimporter.com';
        $subject = 'رسالة جديدة من نموذج الاتصال - ' . $validated['name'];

        Mail::send('emails.contact_message', ['contactMessage' => $contactMessage], function ($mail) use ($adminEmail, $subject) {
            $mail->to($adminEmail)->subject($subject);
        });

        return redirect()->back()->with('success', 'ההודעה נשלחה בהצלחה! ניצור איתך קשר בקרוב.');
    }
}
