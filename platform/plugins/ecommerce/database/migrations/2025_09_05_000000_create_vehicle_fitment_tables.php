<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleFitmentTables extends Migration
{
    public function up()
    {
        Schema::create('makes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->constrained('models')->onDelete('cascade');
            $table->year('year');
            $table->timestamps();
        });

        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade');
            $table->string('name'); // e.g. Petrol 1.2L, Diesel 1.5L
            $table->timestamps();
        });

        Schema::create('product_vehicle_fitments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('ec_products')->onDelete('cascade');
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->foreignId('model_id')->nullable()->constrained('models')->onDelete('cascade');
            $table->foreignId('year_id')->nullable()->constrained('years')->onDelete('cascade');
            $table->foreignId('variant_id')->nullable()->constrained('variants')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_garage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->foreignId('model_id')->nullable()->constrained('models')->onDelete('cascade');
            $table->foreignId('year_id')->nullable()->constrained('years')->onDelete('cascade');
            $table->foreignId('variant_id')->nullable()->constrained('variants')->onDelete('cascade');
            $table->string('nickname')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_garage');
        Schema::dropIfExists('product_vehicle_fitments');
        Schema::dropIfExists('variants');
        Schema::dropIfExists('years');
        Schema::dropIfExists('models');
        Schema::dropIfExists('makes');
    }
}
