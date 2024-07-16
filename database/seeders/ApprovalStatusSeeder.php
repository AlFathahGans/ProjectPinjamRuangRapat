<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Tambahkan 
use Illuminate\Support\Facades\DB;

class ApprovalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('approval_statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Approved'],
            ['name' => 'Rejected'],
        ]);
    }
}
