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
            $table->string('code',10)->unique();
            $table->string('name');
            $table->text('content');
            $table->float('price');
            $table->string('alias');
            $table->string('keyword');
            $table->float('promotion');
            $table->text('description')->nullable();
            $table->integer('hot_product')->default(0);
            $table->integer('status')->default(1);
            $table->integer('id_cate')->unsigned();
            $table->foreign('id_cate')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('admin')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
