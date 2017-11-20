<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('nice_url')->unique();
            $table->text('description');
            $table->float('latitude')->index();
            $table->float('longitude')->index();
            $table->string('address_short')->comment('Short address e.g. only street name');
            $table->string('address');
            $table->tinyInteger('max_persons')->comment('maximum number of persons in flat')->nullable();
            $table->float('dimension')->comment('dimensions in square meters of whole flat/house/room');
            $table->string('phone');
            $table->string('email');
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('featured_till')->nullable();
            $table->integer('announcement_type_id')->unsigned();
            $table->foreign('announcement_type_id')->references('id')->on('announcement_types');
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('announcements');
    }
}
