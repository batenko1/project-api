<?php

use App\Models\Filter;
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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('entity_id')->constrained('entities')->cascadeOnDelete();
            $table->tinyInteger('is_default')->default(0);
            $table->tinyInteger('is_required')->default(0);
            $table->enum('type', Filter::FIELDS)->default(Filter::INPUT_TEXT_FIELD);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
