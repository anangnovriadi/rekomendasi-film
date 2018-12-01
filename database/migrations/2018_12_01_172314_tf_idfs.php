<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TfIdfs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tf_idfs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_film');
            $table->integer('id_term');
            $table->integer('id_user');
            $table->integer('tf');
            $table->double('tf_idf');
            $table->double('tf_idf_kuadrat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tf_idfs');
    }
}
