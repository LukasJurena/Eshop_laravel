<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('photos')) { // Přidání kontroly existence tabulky
            Schema::create('photos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('src');
                $table->string('title')->required();
                $table->string('alt')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
