<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Group;
class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::updateOrCreate(['code' => 'LGU', 'description'=>'Local Goverment Unit']);
        Group::updateOrCreate(['code' => 'HDMF', 'description'=>'Home Development Mutual Fund']);
        Group::updateOrCreate(['code' => 'DHSUD', 'description'=>'Department of Human Settlements and Urban Development']);
    }
}
