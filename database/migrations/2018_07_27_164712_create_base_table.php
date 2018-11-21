<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cone',22);
            $table->string('ctwo',22);
            $table->string('cthree',22);
            $table->string('cfour',22);
            $table->string('cfive',22);
            $table->string('csix',22);
            $table->string('stwof',22);
            $table->string('stwos',22);
            $table->string('stwot',22);
            $table->string('stwox',22);
            $table->string('ssixf',22);
            $table->string('ssixs',22);
            $table->string('ssixt',22);
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
        Schema::dropIfExists('base');
    }
}
