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
        Schema::table('product_value', function (Blueprint $table) {
            $table->longText('value');
            $table->bigInteger('filter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_value', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->dropColumn('filter_id');
        });
    }
};
