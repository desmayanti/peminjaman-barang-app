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
        Schema::table('loans', function (Blueprint $table) {
            $table->date('return_date')->nullable()->change();
            if (!Schema::hasColumn('loans', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->nullable()->after('return_date');
            }
            if (!Schema::hasColumn('loans', 'type')) {
                $table->string('type')->default('pinjam')->after('tanggal_selesai');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'tanggal_selesai')) {
                $table->dropColumn('tanggal_selesai');
            }
            if (Schema::hasColumn('loans', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
