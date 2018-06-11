<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->integer('type');
            $table->string('mobile');
            $table->string('username');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('apartment')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('addr_default')->default(0);
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
        Schema::dropIfExists('addresses');
    }
}
