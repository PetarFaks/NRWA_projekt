<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('AddressID');  // Make sure this is the correct type
            $table->string('AddressLine1', 60);
            $table->string('AddressLine2', 60)->nullable();
            $table->string('City', 30);
            $table->string('PostalCode', 15);
            $table->timestamp('ModifiedDate')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

