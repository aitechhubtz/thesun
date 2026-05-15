<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_page', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_description');
            $table->string('story_title');
            $table->text('story_description');
            $table->string('value1_title')->default('Innovation');
            $table->text('value1_description')->default('Pushing boundaries and embracing new technologies');
            $table->string('value2_title')->default('Passion');
            $table->text('value2_description')->default('Dedicated to excellence in every project');
            $table->string('value3_title')->default('Integrity');
            $table->text('value3_description')->default('Transparent and honest in all our dealings');
            $table->string('value4_title')->default('Collaboration');
            $table->text('value4_description')->default('Working together to achieve greatness');
            $table->string('value5_title')->default('Excellence');
            $table->text('value5_description')->default('Delivering quality beyond expectations');
            $table->string('value6_title')->default('Growth');
            $table->text('value6_description')->default('Continuous improvement and learning');
            $table->integer('projects_count')->default(500);
            $table->integer('clients_count')->default(150);
            $table->integer('years_count')->default(10);
            $table->integer('team_count')->default(25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page');
    }
};
