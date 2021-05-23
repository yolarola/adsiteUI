<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvertArchive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_archives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('img_main')->default('advert.jpg');
            $table->string('img_2')->default('advert.jpg');
            $table->string('img_3')->default('advert.jpg');
            $table->string('folder')->nullable();
            $table -> string('name')->nullable();
            $table -> string('email')->nullable();
            $table -> string('phoneNumber')->nullable();
            $table -> string('advert_name')->nullable();
            $table -> string('main_folder')->default('null');
            $table->string('crop_img_main')->default('crop_advert.jpg');
            $table->string('crop_img_2')->default('crop_advert.jpg');
            $table->string('crop_img_3')->default('crop_advert.jpg');
            $table->integer('AdvertCategory')->nullable();
            $table->integer('price')->nullable();
            $table->string('adress')->nullable();
            $table->text('AdvertText')->nullable();
            $table->integer('moderated')->nullable();
            $table->string('firstName')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
