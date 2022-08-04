<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    DB::table('menus')->truncate();
    DB::table('menus')->insert($this->getUngroupMenus());
    DB::table('menus')->insert($this->getArchiveMenus());
    DB::table('menus')->insert($this->getSystemMenus());
    DB::table('menus')->insert($this->getAccountMenus());
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }

  private function getUngroupMenus()
  {
    return [
      [
        "id" => 1,
        "name" => "Beranda",
        "path" => "home",
        "bi" => "house"
      ], [
        "id" => 2,
        "name" => "Kehadiran",
        "path" => "presences",
        "bi" => "calendar-event"
      ], [
        "id" => 3,
        "name" => "Keuangan",
        "path" => "transactions",
        "bi" => "coin"
      ], [
        "id" => 4,
        "name" => "Rekrutmen",
        "path" => "recruitments",
        "bi" => "person-plus"
      ]
    ];
  }

  private function getArchiveMenus()
  {
    return [
      [
        "id" => 5,
        "name" => "Surat",
        "path" => "archive/letters",
        "bi" => "envelope-paper",
        "group" => "Arsip"
      ], [
        "id" => 6,
        "name" => "Berkas",
        "path" => "archive/files",
        "bi" => "files",
        "group" => "Arsip"
      ]
    ];
  }

  private function getSystemMenus()
  {
    return [
      [
        "id" => 7,
        "name" => "Pengguna",
        "path" => "system/users",
        "bi" => "people",
        "group" => "Sistem"
      ], [
        "id" => 8,
        "name" => "Menu",
        "path" => "system/menus",
        "bi" => "view-list",
        "group" => "Sistem"
      ], [
        "id" => 9,
        "name" => "Peran",
        "path" => "system/roles",
        "bi" => "bookmark-star",
        "group" => "Sistem"
      ], [
        "id" => 10,
        "name" => "Kontak",
        "path" => "system/contacts",
        "bi" => "link-45deg",
        "group" => "Sistem"
      ]
    ];
  }

  private function getAccountMenus()
  {
    return [
      [
        "id" => 11,
        "name" => "Profil",
        "path" => "account/profile",
        "bi" => "person-fill",
        "group" => "Akun"
      ], [
        "id" => 12,
        "name" => "Ubah Password",
        "path" => "account/change-password",
        "bi" => "key-fill",
        "group" => "Akun"
      ]
    ];
  }
}
