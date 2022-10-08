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
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idClient');
            $table->unsignedBigInteger('idRes');
            $table->unsignedBigInteger('idMenu');
            $table->string('nom');
            $table->string('url');
            $table->integer('nombre');
            $table->decimal('prixU');
            $table->decimal('prix');
            $table->string('payement')->nullable()->default(null);
            $table->string('adresse')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('idClient')->references('id')
            ->on('clients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idRes')->references('id')
            ->on('restaurants')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('idMenu')->references('id')
            ->on('menus')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
