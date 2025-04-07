<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Název dopravy (např. "Kurýr", "Osobní odběr")
            $table->decimal('price', 8, 2); // Cena dopravy
            $table->text('description')->nullable(); // Popis
            $table->boolean('is_active')->default(true); // Aktivní/Neaktivní stav
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};