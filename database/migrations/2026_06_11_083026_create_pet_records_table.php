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
        Schema::create('pet_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pet_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('record_type');

            $table->text('memo');

            $table->dateTime('recorded_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_records');
    }
};
