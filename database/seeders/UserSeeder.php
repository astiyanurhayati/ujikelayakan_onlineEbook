<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'astiya',
            'password' => bcrypt('astiya'),
            'email' => 'astiya@gmail.com',
            'address' => 'bogor',
            'phone' => '0948548548503',
            'role' => 'admin',
            'date' => Carbon::now()
        ]);

        User::create([
            'name' => 'nopi',
            'password' => bcrypt('nopi'),
            'email' => 'nopi@gmail.com',
            'address' => 'bogor',
            'phone' => '0948548548503',
            'role' => 'user',
            'date' => Carbon::now()
        ]);

        User::create([
            'name' => 'user',
            'password' => bcrypt('user'),
            'email' => 'user@gmail.com',
            'address' => 'bogor',
            'phone' => '0948548548503',
            'role' => 'user',
            'date' => Carbon::now()
        ]);

        Category::create([
            'name' => 'novel'
        ]);
        Category::create([
            'name' => 'majalah'
        ]);
        Category::create([
            'name' => 'Koran'
        ]);
    }
}
