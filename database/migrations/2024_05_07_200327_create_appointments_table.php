<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medspa_id')->constrained('medspas')->onDelete('cascade');
            $table->timestamp('start_time');
            $table->integer('total_duration')->default(0);
            $table->integer('total_price')->default(0);
            $table->enum('status', ['scheduled', 'completed', 'canceled'])->default('scheduled');
            $table->timestamps();

            $table->index('status', 'appointments_status_index');
            $table->index('start_time', 'appointments_start_time_index');

            $table->index(['status', 'start_time'], 'appointments_status_start_time_index');
        });

    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
