<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('category');
            $table->text('description')->nullable();
            $table->integer('total_stock')->default(1);
            $table->integer('available_stock')->default(1);
            $table->string('icon')->nullable();
            $table->string('status')->default('available'); // available, maintenance, empty
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};