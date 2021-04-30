<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_detail_pembelian");
            $table->unsignedInteger("diskon_persen");
            $table->unsignedInteger("diskon_nominal");
            $table->unsignedInteger("total_harga");
            $table->timestamps();

            $table->foreign("id_detail_pembelian")->references("id")->on("detail_pembelian");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
