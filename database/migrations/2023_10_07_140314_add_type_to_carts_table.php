<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('type')->default('sale');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
