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
        Schema::create('club_modality', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('club_id');
            $table->unsignedBiginteger('modality_id');


            $table->foreign('club_id')->references('id')
                ->on('clubs')->onDelete('cascade');
            $table->foreign('modality_id')->references('id')
                ->on('modalities')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_modality');
    }
};
