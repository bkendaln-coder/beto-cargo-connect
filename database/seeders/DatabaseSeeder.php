<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $agency = Agency::firstOrCreate(
            ['slug' => 'toronto-line-shipping'],
            [
                'name' => 'Toronto Line Shipping',
                'phone' => '+1 514 613 6447',
                'email' => 'contact@torontolineshipping.com',
                'city' => 'Ottawa',
                'country' => 'Canada',
            ]
        );

        User::firstOrCreate(
            ['email' => 'bernard@test.com'],
            [
                'name' => 'Bernard Kenda',
                'password' => 'Password123!',
                'agency_id' => $agency->id,
                'role' => 'super_admin',
            ]
        );
    }
}
