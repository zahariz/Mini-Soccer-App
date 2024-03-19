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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('tim1');
            $table->unsignedTinyInteger('tim2');
            $table->unsignedTinyInteger('goal1');
            $table->unsignedTinyInteger('goal2');
            $table->timestamps();

            $table->foreign('tim1')->references('id')->on('clubs');
            $table->foreign('tim2')->references('id')->on('clubs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
