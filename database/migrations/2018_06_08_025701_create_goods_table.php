<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id');
            $table->string('name');
            $table->string('category_id')->nullable();
            $table->string('en_title');
            $table->string('cn_title');
            $table->float('price');
            $table->float('market_price');
            $table->integer('image1');
            $table->integer('weight')->default(0);
            $table->string('shipping_fee')->default(0);
            $table->string('description')->nullable();
            $table->integer('image2')->default(0);
            $table->integer('image3')->default(0);
            $table->integer('image4')->default(0);
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
        Schema::dropIfExists('goods');
    }
}
