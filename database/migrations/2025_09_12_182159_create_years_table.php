<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->cascadeOnDelete();
            $table->foreignId('model_id')->constrained('models')->cascadeOnDelete();
            $table->string('year');
            $table->timestamps();

            $table->unique(['make_id','model_id','year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('years');
    }
};
