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
        Schema::table('detailtransaksis', function (Blueprint $table) {
            //
            $table->foreignId('transaksi_id')->after('inventaris_id')
                ->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detailtransaksis', function (Blueprint $table) {
            //
            $table->dropForeign('detailtransaksis_transaksi_id_foreign');
            $table->dropColumn('transaksi_id');
        });
    }
};
