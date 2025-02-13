<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('licenseNumber', 20);
            $table->string('phoneNumber', 15);
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->decimal('amount', 10, 2);
            $table->date('date');
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('source', 50);
            $table->decimal('amount', 10, 2);
            $table->date('date');
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('regNumber', 20);
            $table->string('model', 30);
            $table->string('companyName', 50);
        });

        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicleID');
            $table->unsignedBigInteger('driverID');
            $table->string('startingPoint', 100);
            $table->string('destination', 100);
            $table->integer('distanceCovered');
            $table->decimal('charges', 10, 2);
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('trips');
    }
};
