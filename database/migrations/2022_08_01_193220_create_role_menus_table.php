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
