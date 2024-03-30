<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->string('product')->nullable();
            $table->string('product_others')->nullable();
            $table->string('comments')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); 
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
        Schema::dropIfExists('enquiries');
    }
}
