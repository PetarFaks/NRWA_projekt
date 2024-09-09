<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id('SalesOrderDetailID');  // Primary key
            $table->unsignedBigInteger('SalesOrderID');  // Foreign key reference
            $table->unsignedBigInteger('ProductID');  // Foreign key reference
            $table->smallInteger('OrderQty');
            $table->decimal('UnitPrice', 19, 4);
            $table->decimal('UnitPriceDiscount', 19, 4)->default(0.0);
            $table->decimal('LineTotal', 19, 4)->virtualAs('OrderQty * (UnitPrice - UnitPriceDiscount)');
            $table->timestamp('ModifiedDate')->useCurrent();
            $table->timestamps();

            $table->foreign('SalesOrderID')->references('SalesOrderID')->on('sales_orders')->onDelete('cascade');
            $table->foreign('ProductID')->references('ProductID')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_order_details');
    }
}

