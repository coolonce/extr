<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types_of_details');
        });

        Schema::table('passport', function (Blueprint $table) {
            $table->foreign('ch_id')->references('id')->on('characts');
            $table->foreign('det_id')->references('id')->on('details');
        });
        Schema::table('extractors_details', function (Blueprint $table) {
            $table->foreign('detail_id')->references('id')->on('details');
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
        Schema::table('details', function (Blueprint $table) {
            $table->dropForeign('details_type_id_foreign');
        });

        Schema::table('passport', function (Blueprint $table) {
            $table->dropForeign('passport_ch_id_foreign');
            $table->dropForeign('passport_det_id_foreign');
        });

        Schema::table('extractors_details', function (Blueprint $table) {
            $table->dropForeign('extractors_details_detail_id_foreign');
            $table->dropForeign('extractors_details_extractor_id_foreign');
        });
    }
}
