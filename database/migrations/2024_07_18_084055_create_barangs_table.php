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
           
            $table->float('S', 8, 2);
            $table->float('L', 8, 2);
            $table->float('P', 8, 2);
            $table->float('E', 8, 2);
            $table->float('B', 8, 2);
            $table->float('H', 8, 2);
            $table->float('ECR', 8, 2);
            $table->float('R', 8, 2);
            $table->float('RR', 8, 2);

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
