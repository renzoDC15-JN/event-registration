<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user= User::updateOrCreate(['email' => 'admin@admin.com.ph'], ['name' => 'Admin','password'=>Hash::make('weneverknow')]);
        $superAdminRole = Role::where('name', 'super_admin')->first();

        if ($superAdminRole) {
            $user->roles()->syncWithoutDetaching([$superAdminRole->id]);
        }
    }
}
