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
       Schema::create('informasi_ekskuls', function (Blueprint $table) {
    $table->id();
    $table->date('date');
    $table->text('description');
    $table->string('author')->nullable();
    $table->string('time')->nullable();
    $table->string('color')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_ekskuls');
    }
};
