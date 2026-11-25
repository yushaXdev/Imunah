<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vaccination_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('vaccine_id');
            $table->enum('dose', ['1st Dose', '2nd Dose', 'Booster Dose']);
            $table->date('date');
            $table->enum('status', ['Vaccinated', 'Scheduled'])->default('Vaccinated');
        });

        Schema::table('vaccination_status', function (Blueprint $table) {
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospitals')->onDelete('cascade');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments')->onDelete('set null');
            $table->foreign('vaccine_id')->references('vaccine_id')->on('vaccines')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccination_status');
    }
};