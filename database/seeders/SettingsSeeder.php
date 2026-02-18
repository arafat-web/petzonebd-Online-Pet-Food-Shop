<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            // General settings
            ['key' => 'site_name', 'value' => 'PetZone', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_title', 'value' => 'PetZone - Online Pet Food Shop', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Your trusted online pet food store', 'type' => 'text', 'group' => 'general'],
            ['key' => 'currency', 'value' => 'BDT', 'type' => 'string', 'group' => 'general'],

            // Contact settings
            ['key' => 'contact_email', 'value' => 'info@petzone.com', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+880 1234 567890', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'store_address', 'value' => '123 Pet Street, Dhaka', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'store_city', 'value' => 'Dhaka', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'store_zip', 'value' => '1207', 'type' => 'string', 'group' => 'contact'],

            // Policies
            ['key' => 'return_policy', 'value' => 'We accept returns within 7 days of purchase.', 'type' => 'text', 'group' => 'policies'],
            ['key' => 'shipping_policy', 'value' => 'Free shipping on orders above 500 BDT.', 'type' => 'text', 'group' => 'policies'],
            ['key' => 'payment_methods', 'value' => 'Credit Card, Cash on Delivery, Mobile Banking', 'type' => 'text', 'group' => 'policies'],

            // SEO
            ['key' => 'seo_keywords', 'value' => 'pet food, dog food, cat food, online store', 'type' => 'text', 'group' => 'seo'],

            // System
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'system'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
