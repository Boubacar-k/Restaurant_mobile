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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idClient');
            $table->unsignedBigInteger('idRes');
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idCmd');
            $table->unsignedBigInteger('idLivreur')->default(1);
            $table->string('nom');
            $table->integer('nombre');
            $table->string('adresse');
            $table->timestamps();

            $table->foreign('idClient')->references('id')
            ->on('clients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idRes')->references('id')
            ->on('restaurants')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idUser')->references('id')
            ->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idCmd')->references('id')
            ->on('commandes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idLivreur')->references('id')
            ->on('livreurs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraisons');
    }
};
