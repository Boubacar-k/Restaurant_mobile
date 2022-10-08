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
        Schema::create('livreurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idRes');
            $table->string('prenom');
            $table->string('nom');
            $table->string('numtel')->unique();
            $table->string('adresse');
            $table->string('email')->unique();
            $table->string('password')->unique();
            $table->timestamps();

            $table->foreign('idRes')->references('id')
            ->on('restaurants')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livreurs');
    }
};
