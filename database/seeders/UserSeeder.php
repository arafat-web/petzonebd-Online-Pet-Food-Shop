<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@petzone.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@petzone.com',
            'password' => Hash::make('test@123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        echo "\n✓ Admin user created: admin@petzone.com / admin@123\n";
        echo "✓ Test user created: test@petzone.com / test@123\n\n";
    }
}
