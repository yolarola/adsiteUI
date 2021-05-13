<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) 
        {
            //$table->string('folder')->default('null');
            $table->string('crop_img_main')->default('crop_advert.jpg');
            $table->string('crop_img_2')->default('crop_advert.jpg');
            $table->string('crop_img_3')->default('crop_advert.jpg');
            
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
