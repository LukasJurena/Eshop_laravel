<!-- New Products -->
<div class="p-10 bg-gray-100 dark:bg-gray-900"">
    <h2 class=" text-white text-3xl font-semibold text-center" style="font-family: Nunito;">Naše Produkty</h2>
    <div class="overflow-x-auto mt-6">
        <div class="flex space-x-4">
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
    </div>
</div>