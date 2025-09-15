<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['make_id','name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
