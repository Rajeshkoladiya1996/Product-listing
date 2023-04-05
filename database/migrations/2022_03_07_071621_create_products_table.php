<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id');
            $table->string('name',200)->nullable();
            $table->text('discription')->nullable();
            $table->integer('minqty')->default(0);
            $table->integer('maxqty')->default(0);
            $table->integer('price')->default(0);
            $table->string('image')->nullable();
            $table->enum('status',[0,1])->default(0)->comment('0-active,1-inactive');;
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
