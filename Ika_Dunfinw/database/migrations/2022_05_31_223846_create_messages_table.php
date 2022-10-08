<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idRes');
            $table->unsignedBigInteger('idClient');
            $table->text('contenu');
            $table->timestamps();

            $table->foreign('idRes')->references('id')
            ->on('restaurants')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idClient')->references('id')
            ->on('clients')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
