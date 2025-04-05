@extends('layouts.app')

@section('content')
<div class="h-20"> </div>
<div class="container py-10 mx-auto mt-8">
    <h1 class="text-5xl font-semibold text-center mb-8 text-black mt-8 " style="font-family: BebasNeue;">Naše Produkty</h1>

    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .product-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-primary {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .confirmation-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
    </style>
    <!-- Alpine.js musí být ve stránce -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <form method="GET" action="{{ route('products.index') }}" class="flex items-center justify-between mb-6">
        <div x-data="{ open: false, priceFrom: {{ request('price_from', 0) }}, priceTo: {{ request('price_to', 10000) }} }" class="relative">
            <!-- Filtr tlačítko -->
            <button type="button" @click="open = true"
                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-gray-200 rounded hover:bg-gray-300">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-.447.832l-4 2.5A1 1 0 019 21.5V13.414L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                <span style="font-family: Nunito;">Filtr</span>
            </button>

            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

            <div x-show="open" x-transition
                class="fixed top-0 left-0 w-80 h-full bg-white shadow-lg z-50 p-6 overflow-y-auto"
                @click.away="open = false">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Filtr</h2>
                    <button type="button" @click="open = false" class="text-gray-600 hover:text-black">✕</button>
            </div>

            <!-- Range slider -->
            <div class="mb-4">
                <label for="price_range" class="block text-sm mb-1" style="font-family: Nunito;">Rozsah cen:</label>
                
                <!-- Cena od slider -->
                <div class="mb-2">
                    <label for="price_from_range" class="block text-sm" style="font-family: NunitoLight;">Cena od:</label>
                    <input type="range" id="price_from_range" name="price_from" min="0" max="10000" step="1"
                           class="w-full" 
                           x-model="priceFrom"
                           x-bind:value="priceFrom">
                    <div class="text-sm mt-1" style="font-family: NunitoLight;">Hodnota:</div>

                    <!-- Cena od vyplňovací pole -->
                    <input type="number" id="price_from_input" name="price_from" class="w-full p-2 mt-2 border rounded"
                           x-model="priceFrom" min="0">
                </div>

                <!-- Cena do slider -->
                <div class="mb-4">
                    <label for="price_to_range" class="block text-sm" style="font-family: NunitoLight;">Cena do:</label>
                    <input type="range" id="price_to_range" name="price_to" min="0" max="10000" step="1"
                           class="w-full" 
                           x-model="priceTo"
                           x-bind:value="priceTo">
                    <div class="text-sm mt-1" style="font-family: NunitoLight;">Hodnota:</div>

                    <!-- Cena do vyplňovací pole -->
                    <input type="number" id="price_to_input" name="price_to" class="w-full p-2 mt-2 border rounded"
                           x-model="priceTo" min="0" style="font-family: NunitoLight;">
                </div>
            </div>

            <!-- Odeslat -->
            <button type="submit"
                class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700">Použít filtr</button>
        </div>
    </div>


    <!-- PRAVÁ STRANA - Řazení -->
    <div>
        <label for="sort_by" class="sr-only">Řadit podle</label>
        <select name="sort_by" id="sort_by" class="p-2 border border-gray-300 rounded" onchange="this.form.submit()">
            <option value="">Řazení</option>
            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Cena (nejnižší)</option>
            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Cena (nejvyšší)</option>
            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Název (A-Z)</option>
            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Název (Z-A)</option>
        </select>
    </div>
</form>
    
    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="product-image">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2 text-center">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-4 product-description">{{ $product->description }}</p>
                <p>
                    Hodnocení:
                    <strong>{{ number_format($product->averageRating(), 1) }} ⭐</strong>
                    <span class="text-gray-400">({{ $product->reviews->count() }}x)</span>
                </p>
                <p class="font-bold text-lg text-blue-600 mb-4 text-center">Cena: {{ $product->price }} Kč</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn-primary">Zobrazit detaily</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection