<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = new User();
        $adminUser->name = 'Admin';
        $adminUser->email = 'admin@admin.com';
        $adminUser->password = Hash::make('admin0123');
        $adminUser->admin = true;
        $adminUser->save();
    }
}
