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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            $table->string('date_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('quotation_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('product')->nullable();
            $table->string('description')->nullable();
            $table->string('filename')->nullable();
            $table->string('remark')->nullable();

            $table->unsignedBigInteger('submitted_by');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->boolean('excel')->nullable();
            $table->boolean('urgent')->nullable();
            $table->boolean('request_revision')->nullable();

            $table->timestamps();

            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
};
