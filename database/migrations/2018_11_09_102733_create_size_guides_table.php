<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('title', 200);
            $table->longText('description');
            $table->json('sizes');
            $table->foreign('id')->references('id')->on('shops')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('size_guides');
    }
}
