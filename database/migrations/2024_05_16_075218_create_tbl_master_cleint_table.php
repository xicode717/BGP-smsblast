<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterCleintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_cleint', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->text('alamat')->nullable();
            $table->date('tgl_lahir', 50);
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->enum('status', ['1', '0']);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_cleint');
    }
}
