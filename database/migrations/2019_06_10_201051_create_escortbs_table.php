<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscortbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escortbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ucountry');
            $table->string('uname');
            $table->integer('user_id');
            
            $table->text('info');
            $table->string('tel');
            $table->string('email');
            $table->string('city');
            $table->string('national');
            $table->string('age');
            $table->string('look');
            $table->string('lan');
            $table->string('shape');
            $table->string('height');
            $table->string('price');
            $table->string('hobby');
            $table->string('img0');
            $table->string('img1');
            $table->string('img2');
            $table->boolean('verified')->nullable();
            $table->date('expired_at')->nullable();
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
        Schema::dropIfExists('escortbs');
    }
}
