<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('merchant_id');
             /**
     
            * It's common to avoid using float for storing currency values due to potential precision issues with floating-point arithmetic.
            * Instead, I consider using the decimal data type, which allows  to specify the precision and scale. 
            * Precision refers to the total number of digits, and scale refers to the number of digits to the right of the decimal point.
            * we can also use string datatype also
            */
            $table->decimal('commission_rate', 8, 2);
            $table->string('discount_code');
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
        Schema::dropIfExists('affiliates');
    }
};
