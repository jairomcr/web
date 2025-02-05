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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Custom columns
            $table->tinyText('name');

            $table->bigInteger('user_id');

            $table->enum('status', [1, 2])->default(1);

            $table->float('price')->default(0.0);

            $table->tinyText('info')->nullable();

            $table->longText('desc')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
