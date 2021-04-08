<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mores', function (Blueprint $table) {
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
            $table->string('shape');
            $table->string('price');
            $table->string('height');
            $table->string('hobby');
            $table->string('period');
            $table->string('more_type');
            $table->string('img0');
            $table->string('img1');
            $table->string('img2');
            // $table->softDeletes();
            // $table->deleted_at();
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
        Schema::dropIfExists('mores');
    }
}
