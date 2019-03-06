<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

         DB::table('companies')->insert([
            'name' =>  'Wannabees Family Play Town | Frenchs Forest',
            'address' => 'C1 3/1 Rodborough Rd, Frenchs Forest NSW 2086, Australia',
            'phone_number' => '+61 2 8021 6902',
            'website' => 'https://wannabees.com.au/',
            'place_id' => 'ChIJadCegxiqEmsRtLLcBnSv130'
        ]);

    }
}
