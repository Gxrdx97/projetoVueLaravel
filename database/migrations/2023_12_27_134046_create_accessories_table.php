<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoriesTable extends Migration
{
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('accessories');
    }
}
