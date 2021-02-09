<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_user_id')->unsigned();
            $table->dateTime('event_date');
            $table->string('event_title');
            $table->string('contents',10000);
            $table->string('event_image', 500)->nullable($value = true);
            $table->string('performer', 300);
            $table->timestamps();

            $table->foreign('post_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
