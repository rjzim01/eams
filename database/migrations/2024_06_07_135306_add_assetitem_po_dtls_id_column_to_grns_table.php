<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('grns', function (Blueprint $table) {
            $table->string('assetitem_po_dtls_id')->nullable()->after('assetitem_po_mst_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grns', function (Blueprint $table) {
            $table->dropColumn('assetitem_po_dtls_id');
        });
    }
};
