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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('reg_idpel')->nullable();
            $table->string('reg_nama')->nullable();
            $table->string('reg_tgl_lahir')->nullable();
            $table->string('reg_identistas')->nullable();
            $table->string('reg_hp1')->nullable();
            $table->string('reg_hp2')->nullable();
            $table->string('reg_email')->nullable();
            $table->string('reg_alamat_pasang')->nullable();
            $table->string('reg_alamat_tagih')->nullable();
            $table->string('reg_sales')->nullable();
            $table->string('reg_subseles')->nullable();
            $table->string('reg_paket')->nullable();
            $table->string('reg_harga')->nullable();
            $table->string('reg_username')->nullable();
            $table->string('reg_password')->nullable();
            $table->string('reg_tgl_pasang')->nullable();

            $table->string('reg_mrek')->nullable();
            $table->string('reg_sn')->nullable();
            $table->string('reg_status')->nullable();

            $table->string('reg_kabel')->nullable();
            $table->string('reg_kelengkapan')->nullable();
            $table->string('reg_catatan')->nullable();
            $table->string('reg_wilayah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
