<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@treebank.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@treebank.com',
                'password' => Hash::make('11111111'),
            ]
        );
    }
}
