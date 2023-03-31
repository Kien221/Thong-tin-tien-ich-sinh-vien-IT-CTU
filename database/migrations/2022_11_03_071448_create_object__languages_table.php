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
        Schema::create('object__languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_recruit_id')->constrained('post_recruits')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('object__languages');
    }
};
