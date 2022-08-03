<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('google_id')->unique()->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password')->nullable();
      $table->boolean('is_admin')->default(false);
      $table->rememberToken();
      $table->timestamps();

      $table->string('id_number')->nullable();
      $table->boolean('is_male')->nullable();
      $table->string('religion')->nullable();
      $table->string('birth_city')->nullable();
      $table->date('birth_date')->nullable();
      $table->text('hobby')->nullable();
      $table->text('motto')->nullable();
      $table->text('bio')->nullable();
      $table->string('img_path')->nullable();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    Schema::dropIfExists('users');
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }
}
