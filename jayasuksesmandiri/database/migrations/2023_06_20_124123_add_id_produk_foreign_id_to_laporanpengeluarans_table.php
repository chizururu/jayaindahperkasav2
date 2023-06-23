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
        Schema::table('lapor_pengeluarans', function (Blueprint $table) {
            //
            $table->foreignId('produk_id')->after('id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapor_pengeluarans', function (Blueprint $table) {
            //
            $table->dropForeign('lapor_pengeluarans_produk_id_foreign');
            $table->dropColumn('produk_id');
        });
    }
};
