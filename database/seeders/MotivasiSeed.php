<?php

namespace Database\Seeders;

use App\Models\Motivasi;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MotivasiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 10; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		Motivasi::create([
    			'isi_motivasi' => $faker->sentence,
                'id_user' => 1
    		]);
 
    	}
    }
}
