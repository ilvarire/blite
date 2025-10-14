<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 1,
            'password' => Hash::make('password')
        ]);

        DB::table('generals')->insert([
            [
                'checkout' => false,
                'maintenance' => false,
                'location' => '62 FeatherDell, Hatfield, Hertfordshire UK',
                'email' => 'support@blitefood.co.uk',
                'phone' => '+134 3473 38940',
                'facebook_link' => 'https://facebook.com',
                'instagram_link' => 'https://instagram.com',
                'tiktok_link' => 'https://tiktok.com',
                'policy' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.',
                'about' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.',
                'guide' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.',
            ],
        ]);

        DB::table('bankings')->insert([
            [
                'bank_name' => 'STAR BANK PLC',
                'account_name' => 'BLITEFOOD LMT',
                'account_number' => '033948893882'
            ],
        ]);
    }
}
