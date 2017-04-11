<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code', 100)->nullable();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('phoi_do')->nullable();
            $table->string('height')->nullable();
            $table->string('material')->nullable();
            $table->integer('ad_id')->unsigned()->nullable();
            $table->foreign('ad_id')->references('id')->on('advertisments')->onDelete('set null')->onUpdate('cascade')->comment('ma quang cao');
            $table->text('attribute')->comment('kieu json');
            $table->string('img_profile', 100);
            $table->text('img')->comment('kieu json');
            $table->tinyInteger('is_public')->default(0)->comment('0: private, 1:public');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('advertisements');
        Schema::dropIfExists('products');
    }
}
