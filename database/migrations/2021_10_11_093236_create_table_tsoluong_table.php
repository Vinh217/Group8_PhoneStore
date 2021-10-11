<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTsoluongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsoluong', function (Blueprint $table) {
            $table->increments('madt');
            $table->string('mau');
            $table->string('soluong');
            $table->string('dongiaban');
            $table->string('dongianhap');
            $table->string('khuyenmai');
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
        Schema::dropIfExists('tsoluong');
    }
}
