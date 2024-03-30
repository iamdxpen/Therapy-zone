<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductTypeToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->Integer('product_type')->change();
            $table->Integer('product_used_in')->change();
            $table->Integer('product_usage')->change();
            $table->string('device_code')->after('meta_description');
            $table->string('colour')->after('device_code');
            $table->string('wattage')->after('colour');
            $table->dropColumn('technical_description');
            $table->dropColumn('electrical_description');
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
            $table->dropColumn('device_code');
            $table->dropColumn('colour');
            $table->dropColumn('wattage');
            $table->string('technical_description');
            $table->string('electrical_description');
        });
    }
}
