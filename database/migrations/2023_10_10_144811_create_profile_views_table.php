<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileViewsTable extends Migration
{
    public function up()
    {
        Schema::create('profile_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('viewer_id')->nullable();
            $table->timestamp('viewed_at');
            $table->timestamps();

            // Define foreign key relationships, if needed
            // $table->foreign('profile_id')->references('id')->on('profiles');
            // $table->foreign('viewer_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_views');
    }
}
