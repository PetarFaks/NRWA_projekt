<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalesOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_order_details', function (Blueprint $table) {
            // Add new columns
            $table->date('OrderDate')->nullable();
            $table->unsignedBigInteger('UserID');

            // Remove foreign key constraint and SalesOrderID column
            $table->dropForeign(['SalesOrderID']);
            $table->dropColumn('SalesOrderID');

            // Add foreign key constraint for UserID
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
        });

        // Drop the SalesOrder table
        Schema::dropIfExists('sales_orders');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_order_details', function (Blueprint $table) {
            // Add the SalesOrderID column back
            $table->unsignedBigInteger('SalesOrderID');

            // Remove the new columns
            $table->dropColumn('OrderDate');
            $table->dropForeign(['UserID']);
            $table->dropColumn('UserID');

            // Add the foreign key constraint back
            $table->foreign('SalesOrderID')->references('id')->on('sales_orders')->onDelete('cascade');
        });

        // Create the SalesOrder table back
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
