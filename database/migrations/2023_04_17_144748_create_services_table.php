<?php

use App\Models\Category;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->nullable()->constrained();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('preview_image');

            $table->string('first_section_title')->nullable();
            $table->json('first_section_description')->nullable();
            $table->string('first_section_image')->nullable();

            $table->string('second_section_title')->nullable();
            $table->text('second_section_description')->nullable();
            $table->string('second_section_image')->nullable();

            $table->string('third_section_title')->nullable();
            $table->text('third_section_description')->nullable();
            $table->json('third_section_images')->nullable();

            $table->string('slug')->unique();

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
        Schema::dropIfExists('services');
    }
};
