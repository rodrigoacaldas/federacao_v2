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
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('championship_id')->constrained();
            $table->foreignId('category_id')->constrained();

            $table->unsignedBigInteger('club_a_id');
            $table->foreign('club_a_id')->references('id')->on('clubs');

            $table->unsignedBigInteger('club_b_id');
            $table->foreign('club_b_id')->references('id')->on('clubs');

            $table->date('date');
            $table->time('hour');

            $table->boolean('status')->default(0);

            $table->tinyInteger('category_game_number');
            $table->tinyInteger('goals_a')->nullable();
            $table->tinyInteger('goals_b')->nullable();
            $table->tinyInteger('fouls_a')->nullable();
            $table->tinyInteger('fouls_b')->nullable();

            $table->unsignedBigInteger('referee_1_id')->nullable();
            $table->foreign('referee_1_id')->references('id')->on('referees');
            $table->unsignedBigInteger('referee_2_id')->nullable();
            $table->foreign('referee_2_id')->references('id')->on('referees');

            $table->unsignedBigInteger('scorer_1_id')->nullable();
            $table->foreign('scorer_1_id')->references('id')->on('scorers');
            $table->unsignedBigInteger('scorer_2_id')->nullable();
            $table->foreign('scorer_2_id')->references('id')->on('scorers');

            $table->unsignedBigInteger('club_win_id')->nullable();
            $table->foreign('club_win_id')->references('id')->on('clubs');
            $table->unsignedBigInteger('club_lost_id')->nullable();
            $table->foreign('club_lost_id')->references('id')->on('clubs');

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
        Schema::dropIfExists('games');
    }
};
