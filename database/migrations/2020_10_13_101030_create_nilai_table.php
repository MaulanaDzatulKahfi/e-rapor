<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->string('id');
            $table->integer('siswa_id');
            $table->integer('kelas_id');
            $table->integer('semester_id');
            $table->string('sakit');
            $table->string('izin');
            $table->string('alpa');
            $table->string('spiritual');
            $table->string('sosial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
