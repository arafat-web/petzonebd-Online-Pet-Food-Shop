<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $settings = $this->getSettings();
        return view('admin.settings.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'store_address' => 'required|string',
            'store_city' => 'required|string',
            'store_zip' => 'required|string',
            'currency' => 'required|string',
            'return_policy' => 'nullable|string',
            'shipping_policy' => 'nullable|string',
            'payment_methods' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        // Group definitions
        $groupMap = [
            'site_name' => 'general',
            'site_title' => 'general',
            'site_description' => 'general',
            'currency' => 'general',
            'contact_email' => 'contact',
            'contact_phone' => 'contact',
            'store_address' => 'contact',
            'store_city' => 'contact',
            'store_zip' => 'contact',
            'return_policy' => 'policies',
            'shipping_policy' => 'policies',
            'payment_methods' => 'policies',
            'seo_keywords' => 'seo',
            'maintenance_mode' => 'system',
        ];

        // Save each setting to database
        foreach ($validated as $key => $value) {
            $group = $groupMap[$key] ?? 'general';
            $type = ($key === 'maintenance_mode') ? 'boolean' : 'string';
            
            Setting::set($key, $value, $type, $group);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Get all settings from database with defaults
     */
    private function getSettings()
    {
        // Get all settings from database
        $dbSettings = Setting::getAllFlat();

        // Default settings
        $defaults = [
            'site_name' => 'PetZone',
            'site_title' => 'PetZone - Online Pet Food Shop',
            'site_description' => 'Your trusted online pet food store',
            'contact_email' => 'info@petzone.com',
            'contact_phone' => '+880 1234 567890',
            'store_address' => '123 Pet Street, Dhaka',
            'store_city' => 'Dhaka',
            'store_zip' => '1207',
            'currency' => 'BDT',
            'return_policy' => 'We accept returns within 7 days of purchase.',
            'shipping_policy' => 'Free shipping on orders above 500 BDT.',
            'payment_methods' => 'Credit Card, Cash on Delivery, Mobile Banking',
            'seo_keywords' => 'pet food, dog food, cat food, online store',
            'maintenance_mode' => false,
        ];

        // Merge database settings with defaults
        return array_merge($defaults, $dbSettings);
    }
}
