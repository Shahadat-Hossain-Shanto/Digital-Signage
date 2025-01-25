<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('orgName');
            $table->string('mobile');
            $table->string('issueTitle');
            $table->text('issue_description');
            $table->string('ticketNumber')->unique();
            $table->string('status')->default('Received');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_requests');
    }
}
