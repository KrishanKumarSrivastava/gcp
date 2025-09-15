<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->cascadeOnDelete();
            $table->foreignId('model_id')->constrained('models')->cascadeOnDelete();
            $table->foreignId('year_id')->constrained('years')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['make_id','model_id','year_id','name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
