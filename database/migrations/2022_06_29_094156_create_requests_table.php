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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_request')->nullable();
            $table->string('other_description')->nullable();

            $table->string('supplier')->nullable();
            $table->string('price')->nullable();
            $table->string('so_no')->nullable();

            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->string('title1')->nullable();
            $table->string('description1')->nullable();
            $table->string('quantity1')->nullable();
            $table->string('remark1')->nullable();

            $table->string('title2')->nullable();
            $table->string('description2')->nullable();
            $table->string('quantity2')->nullable();
            $table->string('remark2')->nullable();

            $table->string('title3')->nullable();
            $table->string('description3')->nullable();
            $table->string('quantity3')->nullable();
            $table->string('remark3')->nullable();

            $table->string('title4')->nullable();
            $table->string('description4')->nullable();
            $table->string('quantity4')->nullable();
            $table->string('remark4')->nullable();

            $table->timestamps();

            $table->foreign('requested_by')->references('id')->on('users');
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
        Schema::dropIfExists('requests');
    }
};
