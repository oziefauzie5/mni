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
        Schema::create('setting_aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('app_nama')->nullable();
            $table->string('app_brand')->nullable();
            $table->text('app_alamat')->nullable();
            $table->string('app_logo',)->nullable();
            $table->string('app_favicon',)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_aplikasis');
    }
};
