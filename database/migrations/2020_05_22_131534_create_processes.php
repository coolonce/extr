<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('source_id')->unsigned();
            $table->bigInteger('coolant_id')->unsigned();
            $table->bigInteger('extragent_id')->unsigned();
            $table->bigInteger('heater_id')->unsigned();
            $table->bigInteger('extractor_id')->unsigned();
            $table->dateTime('s_datetime');
            $table->dateTime('f_datetime');
            $table->float('start_temperature');
            $table->float('consumption_coolant');
            $table->float('heater_power');
            $table->float('time_extractig');
            $table->float('k_molecular_diffusion');
            $table->float('k_convective_diffusion');
            $table->float('с_saturation');
            $table->float('k_longitudinal_mixing');
            $table->float('c_target');
            $table->float('spent_power');
            $table->float('start_T_coolant');
            $table->timestamps();
        });
        Schema::table('processes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('source_id')->references('id')->on('source');
            $table->foreign('coolant_id')->references('id')->on('coolants');
            $table->foreign('extragent_id')->references('id')->on('extragents');
            $table->foreign('heater_id')->references('id')->on('heaters');
            $table->foreign('extractor_id')->references('id')->on('extractors');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->dropForeign('processes_user_id_foreign');
            $table->dropForeign('processes_source_id_foreign');
            $table->dropForeign('processes_coolant_id_foreign');
            $table->dropForeign('processes_extragent_id_foreign');
            $table->dropForeign('processes_heater_id_foreign');
            $table->dropForeign('processes_extractor_id_foreign');
        });

        Schema::dropIfExists('processes');
    }
}
