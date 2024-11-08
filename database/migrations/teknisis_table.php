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
        Schema::create('teknisis', function (Blueprint $table) {
            $table->id();
            $table->string('teknisi_userid')->nullable();
            $table->string('teknisi_team')->nullable();
            $table->string('teknisi_job')->nullable();
            $table->string('teknisi_idpel')->nullable();
            $table->string('teknisi_start_date')->nullable();
            $table->string('teknisi_end_date')->nullable();
            $table->string('teknisi_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teknisis');
    }
};
