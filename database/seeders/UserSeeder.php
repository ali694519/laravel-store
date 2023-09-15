<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>"Ali Mohammad",
            'email'=>"ali555@gmail.com",
            'password'=>Hash::make('ali00000'),
            'phone_number'=>'0999887766'
        ]);

    }
}
