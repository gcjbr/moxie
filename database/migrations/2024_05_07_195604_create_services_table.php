<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medspa_id')->constrained('medspas')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('duration');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
