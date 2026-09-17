<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_code')->unique();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('nickname');
            $table->string('borrower_name');
            $table->string('phone_number');
            $table->string('email');
            $table->integer('quantity')->default(1);
            $table->date('borrow_date');
            $table->date('return_date');
            $table->text('purpose');
            $table->enum('status', ['pending', 'approved', 'rejected', 'returned'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};