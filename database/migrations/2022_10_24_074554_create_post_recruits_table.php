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
        Schema::create('post_recruits', function (Blueprint $table) {
            $table->id();
            $table->longText('logo')->nullable();
            $table->String('company_name', 255)->nullable();
            $table->foreignId('city_id')->constrained('cities');
            $table->String('company_address', 255)->nullable();
            $table->String('company_phone', 255)->nullable();
            $table->String('company_email', 255)->nullable();
            $table->String('salary', 255)->nullable();
            $table->String('job_title', 255)->nullable();
            $table->longText('job_description', 255)->nullable();
            $table->foreignId('language_id')->constrained('languages');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_recruits');
    }
};
