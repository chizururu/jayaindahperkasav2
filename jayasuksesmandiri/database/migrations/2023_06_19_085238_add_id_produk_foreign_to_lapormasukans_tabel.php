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
        Schema::table('lapormasukans', function (Blueprint $table) {
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
        Schema::table('lapormasukans', function (Blueprint $table) {
            //
            $table->dropForeign('lapormasukans_produk_id_foreign');
            $table->dropColumn('produk_id');
        });
    }
};
