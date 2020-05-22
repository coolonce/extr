<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtragents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extragents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('V');
            $table->string('T_vaporization');
            $table->string('T_condinsasion');
            $table->string('viscosity');
            $table->string('density');
            $table->string('molecular_mass_vap');
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
        Schema::dropIfExists('extragents');
    }
}
