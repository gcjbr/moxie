<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medspas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone_number', 20);
            $table->string('email_address', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medspas');
    }
};
