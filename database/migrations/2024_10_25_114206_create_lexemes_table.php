<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lexemes', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('meaning');
            $table->string('romanized')->nullable();
            $table->string('language');
            $table->unsignedInteger('repetitions')->default(1);
            $table->float('e_factor')->range(1.3, 2.5)->default(2.5);
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lexemes');
    }
};
