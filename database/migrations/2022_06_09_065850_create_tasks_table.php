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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('do_number')->nullable();
            $table->string('customer_name');
            $table->boolean('printing')->nullable();
            $table->boolean('delivered')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('printing_by')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('printing_by')->references('id')->on('users');
            $table->foreign('delivered_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
