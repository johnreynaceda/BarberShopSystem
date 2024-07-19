<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
        ]);

        $shop = Shop::create([
            'name' => 'MASTER SWABE',
            'contact' => '09489203090',
            'address' => 'Tacurong City, SK'
        ]);

        User::create([
            'name' => 'MASTER SWABE',
            'email' => 'masterswabe@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'shop manager',
            'shop_id' => $shop->id,
        ]);

    }
}
