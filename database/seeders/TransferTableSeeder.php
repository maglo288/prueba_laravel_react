<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TransferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('transfers')->insert([[
            'description' => 'Salary',
            'amount' => '4800',
            'wallet_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ], [
            'description' => 'Rent',
            'amount' => '-1200',
            'wallet_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]]);
    }
}
