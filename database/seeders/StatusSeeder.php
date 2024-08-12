<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::updateOrCreate(['code' => '001', 'description'=>'Registered']);
        Status::updateOrCreate(['code' => '002', 'description'=>'Check-in']);
        Status::updateOrCreate(['code' => '003', 'description'=>'Confirm']);
        Status::updateOrCreate(['code' => '004', 'description'=>'Pre-listed']);
    }
}
