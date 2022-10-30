<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('motor_id')->nullable()->constrained()->onDelete('cascade');
            $collection->foreignId('mobil_id')->nullable()->constrained()->onDelete('cascade');
            $collection->string('tahun_keluaran');
            $collection->string('warna');
            $collection->integer('harga');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
}
