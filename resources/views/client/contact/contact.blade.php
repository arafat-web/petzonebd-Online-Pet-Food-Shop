@extends('client.master')

@section('title')
    Contact Us - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div style="background: #f9f9f9; border-bottom: 1px solid var(--border); padding: 1rem 0;">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Get <em style="color: var(--accent); font-style: normal;">In Touch</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">We'd love to hear from you. Send us a message!</p>
        </div>
    </div>

    <!-- ══════════ CONTACT SECTION ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <!-- Address -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <div style="width: 50px; height: 50px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-geo-alt" style="font-size: 1.5rem; color: var(--accent);"></i>
                    </div>
                    <h3 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem;">Address</h3>
                    <p style="color: #666; line-height: 1.6; margin: 0;">
                        Pet Zone Bangladesh<br>
                        Dhaka, Bangladesh
                    </p>
                </div>

                <!-- Phone -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <div style="width: 50px; height: 50px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-telephone" style="font-size: 1.5rem; color: var(--accent);"></i>
                    </div>
                    <h3 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem;">Phone</h3>
                    <p style="color: #666; margin: 0;">
                        <a href="tel:+8801700000000" style="color: var(--accent); text-decoration: none; font-weight: 500;">+880 1700-000000</a>
                    </p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem; margin-bottom: 0;">Mon–Sat: 9am – 6pm</p>
                </div>

                <!-- Email -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="width: 50px; height: 50px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-envelope" style="font-size: 1.5rem; color: var(--accent);"></i>
                    </div>
                    <h3 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem;">Email</h3>
                    <p style="color: #666; margin: 0;">
                        <a href="mailto:hello@petzone.com" style="color: var(--accent); text-decoration: none; font-weight: 500;">hello@petzone.com</a>
                    </p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem; margin-bottom: 0;">We'll reply within 24 hours</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; color: var(--ink); margin-bottom: 1.5rem; letter-spacing: 1px;">Send us a Message</h2>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div style="background: rgba(74,103,65,0.1); border: 1px solid var(--sage); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                            <p style="color: var(--sage); font-size: 0.9rem; margin: 0;">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            </p>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div style="background: rgba(232,82,26,0.1); border: 1px solid rgba(232,82,26,0.3); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <p style="color: var(--accent); font-size: 0.9rem; margin: 0.5rem 0;">
                                    <i class="bi bi-exclamation-circle me-2"></i> {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('name') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('name')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('email') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('email')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone (Optional) -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Phone Number (Optional)</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+880 1XXXXXXXXX" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('phone')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Subject</label>
                            <select name="subject" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('subject') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                                <option value="">-- Select a subject --</option>
                                <option value="product_inquiry" {{ old('subject') == 'product_inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                                <option value="order_issue" {{ old('subject') == 'order_issue' ? 'selected' : '' }}>Order Issue</option>
                                <option value="shipping" {{ old('subject') == 'shipping' ? 'selected' : '' }}>Shipping Question</option>
                                <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership Inquiry</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Message</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('message') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif; resize: vertical;">{{ old('message') }}</textarea>
                            @error('message')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="mb-4" style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <input type="checkbox" id="terms" name="terms" value="1" required style="width: 18px; height: 18px; margin-top: 2px; cursor: pointer; flex-shrink: 0;">
                            <label for="terms" style="margin: 0; color: #666; font-size: 0.85rem; cursor: pointer;">
                                I agree to have my personal information used to respond to my inquiry
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" style="width: 100%; padding: 0.85rem; background: var(--accent); color: white; border: none; border-radius: 0.5rem; font-weight: 600; font-family: 'DM Sans', sans-serif; cursor: pointer; font-size: 1rem; transition: all 0.3s ease;" class="contact-submit-btn">
                            <i class="bi bi-send me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════ FAQ SECTION ══════════ -->
    <div style="background: var(--light-sage); padding: 3rem 0; margin-top: 3rem;">
        <div class="container-xl">
            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--ink); margin-bottom: 0.5rem; text-align: center; letter-spacing: 1px;">Frequently Asked Questions</h2>
            <p style="color: #666; text-align: center; margin-bottom: 2rem;">Find quick answers to common questions</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h4 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-question-circle" style="font-size: 1.3rem; color: var(--accent);"></i>
                            What is the delivery timeframe?
                        </h4>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">We dispatch orders within 24-48 hours. Delivery typically takes 3-5 business days within Dhaka and 5-7 days for outside areas.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h4 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-question-circle" style="font-size: 1.3rem; color: var(--accent);"></i>
                            Do you accept returns?
                        </h4>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Yes, we accept returns within 7 days of purchase if the product is unopened and in original condition. Please contact us for details.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h4 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-question-circle" style="font-size: 1.3rem; color: var(--accent);"></i>
                            What payment methods do you accept?
                        </h4>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">We accept Cash on Delivery, Credit/Debit Cards, Bkash, and Nagad for your convenience.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h4 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-question-circle" style="font-size: 1.3rem; color: var(--accent);"></i>
                            Are your products verified?
                        </h4>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Yes, all our pet food products are 100% authentic and sourced from trusted manufacturers to ensure quality and safety.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-submit-btn:hover {
            background: #d96b1a;
            box-shadow: 0 4px 12px rgba(232,82,26,0.3);
            transform: translateY(-2px);
        }
    </style>
@endsection
