<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("date");
            $table->bigInteger("category_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->text("desc");
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
        Schema::dropIfExists('gists');
    }
}
