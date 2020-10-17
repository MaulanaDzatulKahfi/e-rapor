<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class Siswaseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 36; $i++) {
            DB::table('siswa')->insert([
                'nama_siswa' => $faker->name,
                'nis' => random_int(1, 8),
                'kelas_id' => $faker->numberBetween(1, 2),
            ]);
        }
    }
}
