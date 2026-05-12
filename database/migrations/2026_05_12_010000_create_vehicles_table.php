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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedInteger('hour_meter')->nullable();
            $table->string('location');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('condition')->default('used');
            $table->string('status')->default('available');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->json('images')->nullable();
            $table->json('specifications')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('seller_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
