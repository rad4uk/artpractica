<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->integer('page_id')->unsigned()->nullable();
            $table->foreign('page_id')->references('id')->on('pages')
                ->onDelete('cascade');
            $table->integer('page_sort')->nullable();
            $table->string('page_image')->nullable();
            $table->text('page_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('services_page_id_foreign');
            $table->dropColumn('page_id');
            $table->dropColumn('page_sort');
            $table->dropColumn('page_image');
            $table->dropColumn('page_description');
        });
    }
};
