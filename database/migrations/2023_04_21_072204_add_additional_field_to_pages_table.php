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
        Schema::table('pages', function (Blueprint $table) {
            $table->json('first_section_data')->nullable();
            $table->json('second_section_data')->nullable();
            $table->json('sliders_data')->nullable();
            $table->string('meta_title', 500);
            $table->text('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('first_section_data');
            $table->dropColumn('second_section_data');
            $table->dropColumn('sliders_data');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
};
