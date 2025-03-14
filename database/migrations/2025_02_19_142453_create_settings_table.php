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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('subtitle');
            $table->string('address');
            $table->string('phrase');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('logo')->nullable();
            $table->string('video')->nullable();
            $table->string('video_img')->nullable();
            $table->bigInteger('phone');
            $table->longText('description')->nullable();
            $table->text('extract')->nullable();
            $table->json('executives')->nullable();
            $table->json('social_links')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
