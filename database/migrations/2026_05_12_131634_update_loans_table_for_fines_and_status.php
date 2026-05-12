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
        Schema::table('loans', function (Blueprint $next) {
            $next->decimal('fine_amount', 10, 2)->default(0)->after('due_at');
            $next->decimal('damage_fee', 10, 2)->default(0)->after('fine_amount');
            $next->integer('loan_duration')->default(7)->after('damage_fee'); // in days
            $next->text('notes')->nullable()->after('loan_duration');
            $next->string('status')->default('aktif')->after('notes'); // aktif, kembali, rusak
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $next) {
            $next->dropColumn(['fine_amount', 'damage_fee', 'loan_duration', 'notes', 'status']);
        });
    }
};
