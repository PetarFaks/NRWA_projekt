<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id('SalesOrderID');  // Primary key of sales_orders table
            $table->date('OrderDate');
            $table->unsignedBigInteger('UserID');
            $table->timestamps();

            // Define foreign key
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}

