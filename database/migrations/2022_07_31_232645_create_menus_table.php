<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('menus', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('path');
      $table->string('bi');
      $table->string('group')->nullable();
      $table->softDeletes();
    });

    DB::table('menus')->insert([
      [
        "name" => "Beranda",
        "path" => "home",
        "bi" => "house"
      ], [
        "name" => "Pertemuan",
        "path" => "meetings",
        "bi" => "calendar-event"
      ], [
        "name" => "Keuangan",
        "path" => "transactions",
        "bi" => "coin"
      ], [
        "name" => "Rekrutmen",
        "path" => "recruitments",
        "bi" => "person-plus"
      ]
    ]);

    DB::table('menus')->insert([
      [
        "name" => "Surat",
        "path" => "letters",
        "bi" => "envelope-paper",
        "group" => "Arsip"
      ], [
        "name" => "Berkas",
        "path" => "files",
        "bi" => "files",
        "group" => "Arsip"
      ], [
        "name" => "Pengguna",
        "path" => "users",
        "bi" => "people",
        "group" => "Sistem"
      ], [
        "name" => "Menu",
        "path" => "menus",
        "bi" => "view-list",
        "group" => "Sistem"
      ], [
        "name" => "Peran",
        "path" => "roles",
        "bi" => "bookmark-star",
        "group" => "Sistem"
      ], [
        "name" => "Kontak",
        "path" => "contacts",
        "bi" => "link-45deg",
        "group" => "Sistem"
      ]
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('menus');
  }
}
