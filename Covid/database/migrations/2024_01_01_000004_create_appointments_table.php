<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('hospital_id');
            $table->enum('service_type', ['Covid Test', 'Vaccination']);
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])->default('Pending');
            $table->unsignedBigInteger('vaccine_id')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospitals')->onDelete('cascade');
            $table->foreign('vaccine_id')->references('vaccine_id')->on('vaccines')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};