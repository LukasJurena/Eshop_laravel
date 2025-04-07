<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Definovaný model, ke kterému se tato factory vztahuje.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Definice výchozích hodnot pro testovací data.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Generování náhodného názvu produktu
            'description' => $this->faker->sentence(), // Krátký popis produktu
            'price' => $this->faker->randomFloat(2, 10, 1000), // Cena v rozsahu od 10 do 1000 s dvěma desetinnými místy
            'sku' => strtoupper(Str::random(10)), // Generování náhodného SKU
            'in_stock' => $this->faker->numberBetween(0, 100), // Počet kusů na skladě
            'images' => json_encode(['placeholder.jpg']), // Přidání placeholder obrázku
        ];
    }
}
