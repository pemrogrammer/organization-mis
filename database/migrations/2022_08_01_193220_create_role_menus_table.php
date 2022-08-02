<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('role_menus', function (Blueprint $table) {
      $table->foreignId('role_id')
        ->constrained('roles')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->foreignId('menu_id')
        ->constrained('menus')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->boolean('is_can_create')->default(false);
      $table->boolean('is_can_update')->default(false);
      $table->boolean('is_can_delete')->default(false);

      $table->primary(['role_id', 'menu_id']);
    });


    $role_menus_only_read = [];
    $role_menus_full_access = [];

    foreach ([1, 2, 3, 4, 5, 6] as $menu_id) {
      array_push($role_menus_only_read, [
        'role_id' => 1,
        'menu_id' => $menu_id
      ]);
    }

    foreach ([1, 2, 4, 5, 6] as $menu_id) {
      array_push($role_menus_only_read, [
        'role_id' => 2,
        'menu_id' => $menu_id
      ]);
    }

    array_push($role_menus_full_access, [
      'role_id' => 2,
      'menu_id' => 3,
      'is_can_create' => true,
      'is_can_update' => true,
      'is_can_delete' => true
    ]);

    foreach ([1, 2, 3, 5, 6] as $menu_id) {
      array_push($role_menus_only_read, [
        'role_id' => 3,
        'menu_id' => $menu_id
      ]);
    }

    array_push($role_menus_full_access, [
      'role_id' => 3,
      'menu_id' => 4,
      'is_can_create' => true,
      'is_can_update' => true,
      'is_can_delete' => true
    ]);

    foreach ([1, 2, 3, 4] as $menu_id) {
      array_push($role_menus_only_read, [
        'role_id' => 4,
        'menu_id' => $menu_id
      ]);
    }

    array_push($role_menus_full_access, [
      'role_id' => 4,
      'menu_id' => 5,
      'is_can_create' => true,
      'is_can_update' => true,
      'is_can_delete' => true
    ]);

    array_push($role_menus_full_access, [
      'role_id' => 4,
      'menu_id' => 6,
      'is_can_create' => true,
      'is_can_update' => true,
      'is_can_delete' => true
    ]);


    DB::table('role_menus')->insert($role_menus_only_read);
    DB::table('role_menus')->insert($role_menus_full_access);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('role_menus');
  }
}
