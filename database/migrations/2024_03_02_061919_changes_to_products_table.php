<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->Integer('product_type')->nullable()->change();
            $table->Integer('product_used_in')->nullable()->change();
            $table->Integer('product_use_type')->nullable()->change();
            $table->Integer('product_usage')->nullable()->change();
            $table->string('device_code')->nullable()->change();
            $table->string('colour')->nullable()->change();
            $table->string('wattage')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
