<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_author')->unsigned();
            $table->foreign('id_author')->references('id')->on('authors');

            $table->integer('id_renter')->unsigned()->nullable();
            $table->foreign('id_renter')->references('id')->on('users');

            $table->string('title');
            $table->text('description');
            $table->string('cover');
            $table->boolean('rented')->default(false);
            $table->dateTime('rented_from')->nullable();
            $table->dateTime('rented_to')->nullable();
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
        Schema::drop('books');
    }
}
