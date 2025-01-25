<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('play_list_contents', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->BigInteger('playlist_id'); // Foreign key to playlists table
            $table->string('content'); // Content data
            $table->string('content_type'); // Type of the content
            $table->integer('duration'); // Duration of content in seconds
            $table->integer('order_index'); // Order index for sorting
            $table->unsignedBigInteger('subscriber_id'); // Foreign key to subscribers table
            $table->timestamps(); // created_at and updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('play_list_contents');
    }
};
