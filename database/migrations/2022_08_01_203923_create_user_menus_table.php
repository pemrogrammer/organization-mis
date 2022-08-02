<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_menus', function (Blueprint $table) {
      $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->foreignId('menu_id')
        ->constrained('menus')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->boolean('is_can_create')->default(false);
      $table->boolean('is_can_update')->default(false);
      $table->boolean('is_can_delete')->default(false);

      $table->primary(['user_id', 'menu_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_menus');
  }
}
