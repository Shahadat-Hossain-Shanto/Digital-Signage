<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveDemoRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('live_demo_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('orgName');
            $table->string('mobile');
            $table->integer('numberOfScreen');
            $table->string('screenType');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_demo_requests');
    }
}
