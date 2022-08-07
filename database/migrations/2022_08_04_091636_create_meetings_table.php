<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('meetings', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('description')->nullable();
      $table->string('location')->nullable();
      $table->timestamp('at')->nullable()->comment('it is should not null but Myqsl auto add current_timestamp on update');
      $table->string('category')->nullable();
      $table->string('pass_key')->unique()->nullable();
      $table->timestamp('pass_key_expired_at')->nullable();
      $table->foreignId('created_by_user_id')
        ->constrained('users')
        ->cascadeOnUpdate()
        ->restrictOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('meetings');
  }
}
