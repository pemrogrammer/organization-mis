<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    DB::table('roles')->truncate();
    DB::table('roles')->insert([
      [
        'id' => 1,
        'name' => 'Anggota Biasa'
      ], [
        'id' => 2,
        'name' => 'Bendahara'
      ],
      [
        'id' => 3,
        'name' => 'SDM'
      ],
      [
        'id' => 4,
        'name' => 'Kearsipan'
      ]
    ]);

    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }
}
