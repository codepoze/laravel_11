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
        Schema::create('t_pendaftaran_produk', function (Blueprint $table) {
            $table->integer('id_t_pendaftaran_produk')->autoIncrement();
            $table->integer('id_produk')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->string('palet', 25)->nullable();
            $table->string('remark', 25)->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pendaftaran_produk');
    }
};
