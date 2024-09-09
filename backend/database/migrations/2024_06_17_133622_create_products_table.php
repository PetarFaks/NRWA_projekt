<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('ProductID');
            $table->string('ProductName', 100);
            $table->string('ProductNumber', 15);
            $table->string('Color', 15)->nullable();
            $table->decimal('StandardCost', 19, 4);
            $table->decimal('ListPrice', 19, 4);
            $table->timestamp('ModifiedDate')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
