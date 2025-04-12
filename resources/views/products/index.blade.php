@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Banner -->
    <div class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center mb-4 mt-20" style="font-family: BebasNeue;">NAŠE PRODUKTY</h1>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <!-- Filter and Sort Section -->
        <div class="mb-8">
            <form method="GET" action="{{ route('products.index') }}" x-data="{ 
                filterOpen: false, 
                priceFrom: {{ request('price_from', 0) }}, 
                priceTo: {{ request('price_to', 10000) }}
            }">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <!-- Filter Button and Panel -->
                    <div class="relative">
                        <button type="button" @click="filterOpen = !filterOpen"
                            class="flex items-center gap-2 px-5 py-3 text-black bg-yellow-400 rounded-lg hover:bg-yellow-500 transition-colors shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-.447.832l-4 2.5A1 1 0 019 21.5V13.414L3.293 6.707A1 1 0 013 6V4z" />
                            </svg>
                            <span style="font-family: Nunito;" class="font-semibold">Filtrovat produkty</span>
                        </button>

                        <!-- Filter Panel -->
                        <div x-show="filterOpen" @click.away="filterOpen = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 overflow-hidden">
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-lg font-bold" style="font-family: Nunito;">Filtr produktů</h3>
                                    <button type="button" @click="filterOpen = false" class="text-gray-500 hover:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Price Range -->
                                <div class="mb-6">
                                    <h4 class="font-semibold mb-3" style="font-family: Nunito;">Cenové rozmezí</h4>
                                    
                                    <div class="mb-4">
                                        <label for="price_from" class="block text-sm mb-1" style="font-family: NunitoLight;">
                                            Cena od: <span x-text="priceFrom + ' Kč'" class="font-semibold"></span>
                                        </label>
                                        <input type="range" id="price_from" name="price_from" min="0" max="10000" step="1"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-yellow-400"
                                            x-model="priceFrom">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="price_to" class="block text-sm mb-1" style="font-family: NunitoLight;">
                                            Cena do: <span x-text="priceTo + ' Kč'" class="font-semibold"></span>
                                        </label>
                                        <input type="range" id="price_to" name="price_to" min="0" max="10000" step="1"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-yellow-400"
                                            x-model="priceTo">
                                    </div>

                                    <!-- Price inputs -->
                                    <div class="flex gap-4 mt-4">
                                        <div class="w-1/2">
                                            <label for="price_from_input" class="sr-only">Cena od</label>
                                            <div class="relative">
                                                <input type="number" id="price_from_input" 
                                                    class="w-full p-2 border border-gray-300 rounded-lg pl-8"
                                                    x-model="priceFrom" min="0">
                                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">Kč</span>
                                            </div>
                                        </div>
                                        <div class="w-1/2">
                                            <label for="price_to_input" class="sr-only">Cena do</label>
                                            <div class="relative">
                                                <input type="number" id="price_to_input" 
                                                    class="w-full p-2 border border-gray-300 rounded-lg pl-8"
                                                    x-model="priceTo" min="0">
                                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">Kč</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categories (example) -->
                                <div class="mb-6">
                                    <h4 class="font-semibold mb-3" style="font-family: Nunito;">Kategorie</h4>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="category[]" value="skateboards" class="rounded text-yellow-500 focus:ring-yellow-500">
                                            <span class="ml-2" style="font-family: NunitoLight;">Skateboardy</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="category[]" value="longboards" class="rounded text-yellow-500 focus:ring-yellow-500">
                                            <span class="ml-2" style="font-family: NunitoLight;">Longboardy</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="category[]" value="wheels" class="rounded text-yellow-500 focus:ring-yellow-500">
                                            <span class="ml-2" style="font-family: NunitoLight;">Kolečka</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="category[]" value="accessories" class="rounded text-yellow-500 focus:ring-yellow-500">
                                            <span class="ml-2" style="font-family: NunitoLight;">Doplňky</span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
                                    Použít filtr
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="flex items-center">
                        <label for="sort_by" class="mr-2 font-medium" style="font-family: Nunito;">Řadit podle:</label>
                        <select name="sort_by" id="sort_by" 
                            class="p-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                            onchange="this.form.submit()" style="font-family: NunitoLight;">
                            <option value="">Vyberte </option>
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Cena (nejnižší)</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Cena (nejvyšší)</option>
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Název (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Název (Z-A)</option>
                            <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Nejlépe hodnocené</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Active Filters (optional) -->
        @if(request('price_from') > 0 || request('price_to') < 10000 || request('category'))
        <div class="mb-6 flex flex-wrap gap-2">
            <span class="text-sm text-gray-600" style="font-family: Nunito;">Aktivní filtry:</span>
            
            @if(request('price_from') > 0)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                Cena od: {{ request('price_from') }} Kč
                <a href="{{ request()->fullUrlWithQuery(['price_from' => 0]) }}" class="ml-1 text-yellow-800 hover:text-yellow-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </span>
            @endif
            
            @if(request('price_to') < 10000)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                Cena do: {{ request('price_to') }} Kč
                <a href="{{ request()->fullUrlWithQuery(['price_to' => 10000]) }}" class="ml-1 text-yellow-800 hover:text-yellow-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </span>
            @endif
            
            <a href="{{ route('products.index') }}" class="text-sm text-black hover:text-yellow-600 underline ml-2" style="font-family: NunitoLight;">
                Zrušit všechny filtry
            </a>
        </div>
        @endif

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group relative bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                <!-- Badge (optional) -->
                @if($product->is_new)
                <div class="absolute top-3 left-3 z-10">
                    <span class="inline-block bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold" style="font-family: Nunito;">NOVINKA</span>
                </div>
                @endif
                
                <!-- Product Image with Hover Effect -->
                <div class="relative overflow-hidden h-64">
                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                        <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </a>
                    
                    <!-- Quick View Button (optional) -->
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a href="{{ route('products.show', $product->id) }}" 
                            class="bg-black text-white px-4 py-2 rounded-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                            style="font-family: Nunito;">
                            Přejít na produkt
                        </a>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-5 flex flex-col flex-grow">
                    <div class="mb-2 flex items-center">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->averageRating()))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs text-gray-500 ml-1" style="font-family: NunitoLight;">
                            ({{ $product->reviews->count() }})
                        </span>
                    </div>
                    
                    <h2 class="text-lg font-bold mb-2" style="font-family: Nunito;">{{ $product->name }}</h2>
                    
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow" style="font-family: NunitoLight;">
                        {{ $product->description }}
                    </p>
                    
                    <div class="mt-auto">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xl font-bold text-black" style="font-family: Nunito;">{{ $product->price }} Kč</span>
                            
                            @if($product->old_price)
                            <span class="text-sm line-through text-gray-500" style="font-family: NunitoLight;">
                                {{ $product->old_price }} Kč
                            </span>
                            @endif
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" 
                                class="flex-1 bg-black text-white text-center py-2 rounded-lg hover:bg-gray-800 transition-colors"
                                style="font-family: Nunito;">
                                Detail
                            </a>
                            <!-- Add to Cart Button -->
                            <button type="button" 
                                    class="bg-yellow-400 text-black px-3 py-2 rounded-lg hover:bg-yellow-500 transition-colors"
                                    onclick="addToCart({{ $product->id }})"
                                    title="Přidat do košíku">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($products) === 0)
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Žádné produkty nenalezeny</h3>
            <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Zkuste změnit filtry nebo vyhledat jiné produkty.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-yellow-400 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors" style="font-family: Nunito;">
                Zobrazit všechny produkty
            </a>
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>

<!-- Add to Cart Confirmation -->
<div id="cart-confirmation" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 shadow-2xl transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Produkt přidán do košíku</h3>
            <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Produkt byl úspěšně přidán do vašeho košíku.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" onclick="closeCartConfirmation()" 
                    class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition-colors"
                    style="font-family: Nunito;">
                    Pokračovat v nákupu
                </button>
                <a href="{{ route('cart.index') }}" 
                    class="flex-1 bg-yellow-400 text-black py-2 rounded-lg hover:bg-yellow-500 transition-colors text-center"
                    style="font-family: Nunito;">
                    Přejít do košíku
                </a>
            </div>
        </div>
    </div>
</div>


<script>
// Function to add product to the cart
    function addToCart(productId) {
        // Show the confirmation modal
        document.getElementById('cart-confirmation').classList.remove('hidden');
        
        // Send AJAX request to add the product to the cart
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ensure CSRF token is present
            },
            body: JSON.stringify({
                stay: 'false'  // Change to 'true' if you want to stay on the page after adding to the cart
            })
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                // Successfully added to cart (you can handle more here)
                console.log('Product added to cart!');
            } else {
                console.error('Failed to add to cart:', data.message || 'Unknown error');
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
        });
    }

    // Close the confirmation modal
    function closeCartConfirmation() {
        document.getElementById('cart-confirmation').classList.add('hidden');
    }
</script>

<style>
    /* Custom styles for range inputs */
    input[type="range"] {
        -webkit-appearance: none;
        height: 6px;
        background: #e5e7eb;
        border-radius: 5px;
        background-image: linear-gradient(#fbbf24, #fbbf24);
        background-repeat: no-repeat;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #fbbf24;
        cursor: pointer;
        box-shadow: 0 0 2px 0 #555;
    }

    input[type="range"]::-moz-range-thumb {
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #fbbf24;
        cursor: pointer;
        box-shadow: 0 0 2px 0 #555;
        border: none;
    }

    /* Line clamp for product descriptions */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination > * {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
        background-color: white;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .pagination > .active {
        background-color: #fbbf24;
        color: black;
        border-color: #fbbf24;
    }

    .pagination > *:hover:not(.active) {
        background-color: #f9fafb;
    }
</style>
@endsection