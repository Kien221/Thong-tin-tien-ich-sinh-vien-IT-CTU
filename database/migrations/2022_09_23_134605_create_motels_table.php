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
        Schema::create('motels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards');
            $table->String('MotelName',50);
            $table->String('img')->nullable();
            $table->String('Address',50)->nullable();
            $table->String('Phone',20);
            $table->bigInteger('prices')->nullable();
            $table->smallInteger('status')->comment('MotelStatus')->index()->default(1);
            $table->String('Description',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motels');
    }
};
