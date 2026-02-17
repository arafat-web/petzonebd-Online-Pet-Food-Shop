<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('client.contact.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|in:product_inquiry,order_issue,shipping,feedback,partnership,other',
            'message' => 'required|string|min:10',
            'terms' => 'required',
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message must be at least 10 characters long.',
            'terms.required' => 'You must agree to the privacy terms.',
        ]);

        // TODO: Save to database or send email
        // For now, just display success message
        // You can later integrate with Mailer or database storage

        return redirect()->route('contact.show')
            ->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
