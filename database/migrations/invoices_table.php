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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('inv_id')->nullable();
            $table->string('inv_status')->nullable();
            $table->string('inv_idpel')->nullable();
            $table->string('inv_paket')->nullable();
            $table->string('inv_mitra')->nullable();
            $table->string('inv_tgl_tagih')->nullable();
            $table->string('inv_tgl_jatuh_tempo')->nullable();
            $table->string('inv_tgl_isolir')->nullable();
            $table->string('inv_tgl_bayar')->nullable();
            $table->string('inv_periode')->nullable();
            $table->string('inv_diskon')->nullable();
            $table->string('inv_fee_sales')->nullable();
            $table->string('inv_total')->nullable();
            $table->string('inv_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
