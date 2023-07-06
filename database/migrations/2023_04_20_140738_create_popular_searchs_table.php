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
        Schema::create('popular_searchs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('key_word')->nullable();
            $table->text('text')->nullable();
            $table->text('img_src')->nullable();
            $table->text('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popular_searchs');
    }
};
