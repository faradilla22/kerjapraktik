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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('status');
            $table->string('item_no');
            $table->string('item_name');
           
            $table->integer('S');
            $table->integer('L');
            $table->integer('P');
            $table->integer('E');
            $table->integer('B');
            $table->integer('H');
            $table->integer('ECR');
            $table->integer('R');
            $table->integer('RR');

            $table->unsignedBigInteger('id_pabrik');
            $table->unsignedBigInteger('id_bagian');

            $table->foreign('id_pabrik')->references('id')->on('pabriks')->onDelete('cascade');
            $table->foreign('id_bagian')->references('id')->on('bagians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
