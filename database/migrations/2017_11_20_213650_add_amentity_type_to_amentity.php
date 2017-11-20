<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmentityTypeToAmentity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amentities', function (Blueprint $table) {
            $table->integer('amentity_type_id')->unsigned();
            $table->foreign('amentity_type_id')->references('id')->on('amentity_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amentities', function (Blueprint $table) {
            $table->dropForeign(['amentity_type_id']);
            $table->dropColumn('amentity_type_id');
        });
    }
}
