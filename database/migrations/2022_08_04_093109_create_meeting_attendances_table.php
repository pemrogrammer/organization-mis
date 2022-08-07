<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingAttendancesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('meeting_attendances', function (Blueprint $table) {
      
      $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->foreignId('meeting_id')
        ->constrained('meetings')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->primary(['user_id', 'meeting_id']);

      $table->boolean('is_should_attend');
      $table->timestamp('attended_at')->nullable();

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
    Schema::dropIfExists('meeting_attendances');
  }
}
