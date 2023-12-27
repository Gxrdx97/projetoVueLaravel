<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosAcessoriosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos_acessorios', function (Blueprint $table) {
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('acessorio_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('acessorio_id')->references('id')->on('accessories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos_acessorios');
    }
}
