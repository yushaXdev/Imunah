<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id('result_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->enum('result', ['Positive', 'Negative']);
            $table->text('remarks')->nullable();
            $table->date('date');
        });

        Schema::table('test_results', function (Blueprint $table) {
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospitals')->onDelete('cascade');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};