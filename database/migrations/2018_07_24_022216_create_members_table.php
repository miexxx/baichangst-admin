<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->string('contacts',20);
            $table->string('tel',20);
            $table->string('email',30);
            $table->string('postcode',20);
            $table->string('logo',255);
            $table->string('adrcode',20);
            $table->string('adrdetail',200);
            $table->string('xpoint',10)->nullable();
            $table->string('ypoint',20)->nullable();
            $table->unsignedInteger('sort')->default(0);
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
        Schema::dropIfExists('members');
    }
}
