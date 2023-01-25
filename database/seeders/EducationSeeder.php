<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
          [
            'id' => 1,
            'name' => 'SD/MI'
          ], [
            'id' => 2,
            'name' => 'SMP/MTS'
          ],
          [
            'id' => 3,
            'name' => 'SMK/SMA/MA'
          ],
          [
            'id' => 4,
            'name' => 'D3'
          ],
          [
            'id' => 5,
            'name' => 'D4'
          ],
          [
            'id' => 6,
            'name' => 'S1'
          ],
          [
            'id' => 7,
            'name' => 'S2'
          ],
          [
            'id' => 8,
            'name' => 'S3'
          ]
        ]);
    }
}
