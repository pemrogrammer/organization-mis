<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMembersContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fa_icon');
            $table->string('url_prefix');
            $table->string('url_suffix')->nullable();
        });

        DB::table('members_contacts')->insert([
            [
                'name' => 'Phone',
                'fa_icon' => 'fas fa-phone',
                'url_prefix' => 'tel:+'
            ],
            [
                'name' => 'email',
                'fa_icon' => 'far fa-envelope',
                'url_prefix' => 'mailto:'
            ],
            [
                'name' => 'WhatsApp',
                'fa_icon' => 'fab fa-whatsapp',
                'url_prefix' => 'https://wa.me/'
            ], [
                'name' => 'Instagram',
                'fa_icon' => 'fab fa-instagram',
                'url_prefix' => 'https://instagram.com/'
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
        Schema::dropIfExists('members_contacts');
    }
}
