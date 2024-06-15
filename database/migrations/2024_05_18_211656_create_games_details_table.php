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
        Schema::create('game_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('game_id')->constrained();

            $table->unsignedBigInteger('club_a_id');
            $table->foreign('club_a_id')->references('id')->on('clubs');
            $table->json('athlete_a_1')->nullable();
            $table->json('athlete_a_2')->nullable();
            $table->json('athlete_a_3')->nullable();
            $table->json('athlete_a_4')->nullable();
            $table->json('athlete_a_5')->nullable();
            $table->json('athlete_a_6')->nullable();
            $table->json('athlete_a_7')->nullable();
            $table->json('athlete_a_8')->nullable();
            $table->json('athlete_a_9')->nullable();
            $table->json('athlete_a_10')->nullable();

            $table->unsignedBigInteger('club_b_id');
            $table->foreign('club_b_id')->references('id')->on('clubs');
            $table->json('athlete_b_1')->nullable();
            $table->json('athlete_b_2')->nullable();
            $table->json('athlete_b_3')->nullable();
            $table->json('athlete_b_4')->nullable();
            $table->json('athlete_b_5')->nullable();
            $table->json('athlete_b_6')->nullable();
            $table->json('athlete_b_7')->nullable();
            $table->json('athlete_b_8')->nullable();
            $table->json('athlete_b_9')->nullable();
            $table->json('athlete_b_10')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_details');
    }
};
