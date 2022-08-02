<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUser extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('id_number')->nullable();
      $table->boolean('is_banned')->default(false);
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
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('id_number');
      $table->dropColumn('is_banned');
      $table->dropColumn('is_male');
      $table->dropColumn('religion');
      $table->dropColumn('birth_city');
      $table->dropColumn('birth_date');
      $table->dropColumn('hobby');
      $table->dropColumn('motto');
      $table->dropColumn('bio');
      $table->dropColumn('img_path');
      $table->dropColumn('deleted_at');
    });
  }
}
