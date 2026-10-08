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
        Schema::table('items', function (Blueprint $table) {
            if (!Schema::hasColumn('items', 'is_consumable')) {
                $table->boolean('is_consumable')->default(false);
            }
            if (!Schema::hasColumn('items', 'max_request_qty')) {
                $table->integer('max_request_qty')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['is_consumable', 'max_request_qty']);
        });
    }
};
