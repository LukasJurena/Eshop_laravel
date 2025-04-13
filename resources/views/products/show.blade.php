@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-20">
    <!-- Product Detail Section -->
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-black hover:text-yellow-600 transition-colors">
                    <x-heroicon-s-arrow-left class="h-5 w-5 mr-2" />
                <span style="font-family: Nunito;" class="font-semibold">Zpět na produkty</span>
            </a>
        </div>

        <!-- Product Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Product Image Gallery - Left Side -->
                <div class="w-full lg:w-1/2 p-6 lg:p-8 bg-black">
                    <!-- Main Image -->
                    <div class="relative mb-6 overflow-hidden rounded-xl bg-gray-900 flex items-center justify-center">
                        @if (!empty($product->images))
                            <img id="main-image" src="{{ asset('storage/' . $product->images[0]) }}"
                                alt="{{ $product->name }}"
                                class="product-image object-contain rounded-xl transition-all duration-300 hover:scale-105"
                                style="height: 400px; width: 100%; cursor: zoom-in;">
                            
                            <!-- Overlay with zoom icon -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 flex items-center justify-center transition-all duration-300 opacity-0 hover:opacity-100 cursor-pointer">
                                <x-heroicon-o-magnifying-glass-plus class="h-12 w-12 text-white" />
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnails Carousel -->
                    <div class="relative px-8">
                        <button id="prev-image" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-yellow-400 text-black p-2 rounded-full hover:bg-yellow-500 transition-colors z-10">
                            <x-heroicon-s-chevron-left class="h-5 w-5" />
                        </button>
                        
                        <div class="overflow-hidden">
                            <div class="flex gap-4 transition-transform duration-300" id="image-carousel">
                                @foreach ($product->images as $index => $image)
                                    <div class="flex-shrink-0" style="width: 80px;">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-20 h-20 object-cover rounded-lg cursor-pointer image-thumbnail {{ $index === 0 ? 'ring-2 ring-yellow-400' : '' }}"
                                            data-index="{{ $index }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <button id="next-image" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-yellow-400 text-black p-2 rounded-full hover:bg-yellow-500 transition-colors z-10">
                            <x-heroicon-s-chevron-right class="h-5 w-5" />
                        </button>
                    </div>
                </div>

                <!-- Product Information - Right Side -->
                <div class="w-full lg:w-1/2 p-6 lg:p-8">
                    <div class="flex flex-col h-full">
                        <!-- Product Header -->
                        <div class="mb-6">
                            <h1 class="text-3xl lg:text-4xl font-bold mb-2" style="font-family: BebasNeue;">{{ $product->name }}</h1>
                            
                            <!-- Rating -->
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($product->averageRating()))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600" style="font-family: NunitoLight;">
                                    {{ number_format($product->averageRating(), 1) }} ({{ $product->reviews->count() }} {{ $product->reviews->count() == 1 ? 'recenze' : 'recenzí' }})
                                </span>
                            </div>
                            
                            <!-- Price -->
                            <div class="flex items-center mb-6">
                                <span class="text-3xl font-bold text-black" style="font-family: Nunito;">{{ $product->price }} Kč</span>
                                @if(isset($product->old_price) && $product->old_price > $product->price)
                                    <span class="ml-3 text-lg line-through text-gray-500" style="font-family: NunitoLight;">{{ $product->old_price }} Kč</span>
                                    <span class="ml-3 bg-yellow-400 text-black px-2 py-1 rounded-md text-sm font-bold">
                                        -{{ round((1 - $product->price / $product->old_price) * 100) }}%
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-6">
                                <p class="text-gray-700" style="font-family: NunitoLight;">{{ $product->description }}</p>
                            </div>
                        </div>
                        
                        <!-- Product Details -->
                        <div class="mb-6 grid grid-cols-2 gap-4 border-t border-b border-gray-200 py-4">
                            <div class="flex items-center">
                                <x-heroicon-o-document-text class="h-5 w-5 text-gray-500 mr-2" />
                                <span class="text-sm text-gray-600" style="font-family: NunitoLight;">
                                    <strong style="font-family: Nunito;">SKU:</strong> {{ $product->sku }}
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <x-heroicon-o-archive-box class="h-5 w-5 text-gray-500 mr-2" />
                                <span class="text-sm text-gray-600" style="font-family: NunitoLight;">
                                    <strong style="font-family: Nunito;">Skladem:</strong> 
                                    @if($product->in_stock > 10)
                                        <span class="text-green-600">Skladem ({{ $product->in_stock }} ks)</span>
                                    @elseif($product->in_stock > 0)
                                        <span class="text-yellow-600">Poslední kusy ({{ $product->in_stock }} ks)</span>
                                    @else
                                        <span class="text-red-600">Není skladem</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex items-center">
                                <x-heroicon-o-cube class="h-5 w-5 text-gray-500 mr-2" />
                                <strong style="font-family: Nunito;">Kategorie:</strong> {{ $product->category->name ?? 'Nezařazeno' }}
                            </div>
                            
                            <div class="flex items-center">
                                <x-heroicon-o-clock class="h-5 w-5 text-gray-500 mr-2" />
                                <span class="text-sm text-gray-600" style="font-family: NunitoLight;">
                                    <strong style="font-family: Nunito;">Dodání:</strong> 1-3 pracovní dny
                                </span>
                            </div>
                        </div>
                        
                        <!-- Add to Cart Section -->
                        <div class="mt-auto">
                            <div class="flex items-center mb-4">
                                <div class="mr-4">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Množství</label>
                                    <div class="custom-number-input h-10 w-32">
                                        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent">
                                            <button data-action="decrement" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-300 h-full w-10 rounded-l cursor-pointer outline-none flex items-center justify-center">
                                                <span class="m-auto text-xl font-thin">−</span>
                                            </button>
                                            <input type="number" id="quantity" class="outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black md:text-base cursor-default flex items-center text-gray-700" name="quantity" value="1" min="1" max="{{ $product->in_stock }}">
                                            <button data-action="increment" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-300 h-full w-10 rounded-r cursor-pointer flex items-center justify-center">
                                                <span class="m-auto text-xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex space-x-4">
                                <button type="button" 
                                    onclick="showConfirmationBox({{ $product->id }})" 
                                    class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center"
                                    {{ $product->in_stock <= 0 ? 'disabled' : '' }}
                                    style="font-family: Nunito;">
                                    <x-heroicon-o-shopping-cart class="h-5 w-5 mr-2" />
                                    Přidat do košíku
                                </button>
                                
                                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 p-3 rounded-lg transition-colors">
                                    <x-heroicon-o-heart class="h-6 w-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
<div class="mt-12">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 lg:p-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center" style="font-family: BebasNeue;">
                <x-heroicon-s-star class="h-6 w-6 mr-2 text-yellow-400" />
                HODNOCENÍ ZÁKAZNÍKŮ
            </h2>
            
            <!-- Review Summary -->
            <div class="flex flex-col md:flex-row gap-8 mb-8 pb-8 border-b border-gray-200">
    <!-- Left: Average Rating -->
    <div class="w-full md:w-1/3 flex flex-col items-center justify-center">
        <div class="text-5xl font-bold text-black mb-2" style="font-family: Nunito;">
            {{ number_format($product->averageRating(), 1) }}
        </div>
        <div class="flex text-yellow-400 mb-2">
            @php
                $avgRating = round($product->averageRating());
            @endphp
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $avgRating)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @else
                
                @endif
            @endfor
        </div>
                    <div class="text-sm text-gray-600" style="font-family: NunitoLight;">
                        Celkem {{ $product->reviews->count() }} {{ $product->reviews->count() == 1 ? 'hodnocení' : 'hodnocení' }}
                    </div>
                </div>
                        <!-- Right: Rating Breakdown -->
                        <div class="w-full md:w-2/3">
                            @php
                                $ratingCounts = [0, 0, 0, 0, 0];
                                foreach($product->reviews as $review) {
                                    $ratingCounts[$review->rating - 1]++;
                                }
                                $totalReviews = $product->reviews->count() ?: 1; // Avoid division by zero
                            @endphp
                            
                            @for($i = 5; $i >= 1; $i--)
                                <div class="flex items-center mb-2">
                                    <div class="w-12 text-sm text-gray-600" style="font-family: NunitoLight;">{{ $i }} ★</div>
                                    <div class="flex-1 mx-4">
                                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-yellow-400 rounded-full" style="width: {{ ($ratingCounts[$i-1] / $totalReviews) * 100 }}%"></div>
                                        </div>
                                    </div>
                                    <div class="w-12 text-sm text-right text-gray-600" style="font-family: NunitoLight;">
                                        {{ $ratingCounts[$i-1] }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Reviews List -->
                    <div class="space-y-6">
                        @if($product->reviews->count() > 0)
                            @foreach($product->reviews as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                    <div class="flex items-center mb-2">
                                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-yellow-600 font-bold" style="font-family: Nunito;">
                                                {{ substr($review->user->name ?? 'Anonym', 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold" style="font-family: Nunito;">
                                                {{ $review->user->name ?? 'Anonymní uživatel' }}
                                            </h4>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @else
                                                            
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="ml-2 text-xs text-gray-500" style="font-family: NunitoLight;">
                                                    {{ $review->created_at->format('d.m.Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-700" style="font-family: NunitoLight;">{{ $review->comment }}</p>
                            </div >
                            @endforeach
                        @else
                            <div class="text-center py-8">
                            <x-heroicon-o-chat-bubble-bottom-center-text class="h-12 w-12 text-gray-400 mx-auto mb-4" />
                                <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Zatím žádné recenze</h3>
                                <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Buďte první, kdo ohodnotí tento produkt!</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Add Review Form -->
                    @auth
                        @php
                            $existingReview = $product->reviews->where('user_id', Auth::id())->first();
                        @endphp

                        @if($existingReview)
                            <div class="mt-8 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <p class="text-center text-gray-700" style="font-family: Nunito;">
                                    Děkujeme za vaši recenzi! Již jste tento produkt ohodnotili.
                                </p>
                            </div>
                        @else
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h3 class="text-xl font-bold mb-4" style="font-family: Nunito;">Přidat recenzi</h3>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="mb-4">
                                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Hodnocení</label>
                                        <div class="flex items-center rating-input">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="cursor-pointer p-1">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300 hover:text-yellow-400 transition-colors star-icon" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Komentář</label>
                                        <textarea name="comment" id="comment" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent" style="font-family: NunitoLight;"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="bg-black text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-colors" style="font-family: Nunito;">
                                        Odeslat recenzi
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg text-center">
                            <p class="text-gray-700 mb-4" style="font-family: NunitoLight;">Pro přidání recenze se prosím přihlaste.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-black text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-colors" style="font-family: Nunito;">
                                Přihlásit se
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6 flex items-center" style="font-family: BebasNeue;">
                <x-heroicon-o-squares-2x2 class="h-6 w-6 mr-2 text-yellow-400" />
                SOUVISEJÍCÍ PRODUKTY
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                        <!-- Product Image with Hover Effect -->
                        <div class="relative overflow-hidden h-48">
                            <a href="{{ route('products.show', $relatedProduct->id) }}" class="block h-full">
                                <img src="{{ asset('storage/' . $relatedProduct->images[0]) }}" alt="{{ $relatedProduct->name }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </a>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="mb-2 flex items-center">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($relatedProduct->averageRating()))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-bold mb-2" style="font-family: Nunito;">{{ $relatedProduct->name }}</h3>
                            
                            <div class="mt-auto">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xl font-bold text-black" style="font-family: Nunito;">{{ $relatedProduct->price }} Kč</span>
                                </div>
                                
                                <a href="{{ route('products.show', $relatedProduct->id) }}" 
                                    class="block w-full bg-black text-white text-center py-2 rounded-lg hover:bg-gray-800 transition-colors"
                                    style="font-family: Nunito;">
                                    Zobrazit detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Add to Cart Confirmation Modal -->
<div id="confirmation-box-{{ $product->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4 transform transition-all">
        <div class="text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <x-heroicon-o-check class="h-8 w-8 text-yellow-500" />
            </div>
            <h3 class="text-xl font-bold mb-2" style="font-family: Nunito;">Produkt přidán do košíku</h3>
            <p class="text-gray-600 mb-6" style="font-family: NunitoLight;">Co si přejete udělat dále?</p>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="stay" value="true">
                    <input type="hidden" name="quantity" id="modal-quantity-stay" value="1">
                    <button type="submit"
                        class="w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-lg hover:bg-gray-300 transition-colors"
                        style="font-family: Nunito;">
                        Pokračovat v nákupu
                    </button>
                </form>
                
                <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="stay" value="false">
                    <input type="hidden" name="quantity" id="modal-quantity" value="1">
                    <button type="submit"
                        class="w-full bg-yellow-400 text-black py-3 px-4 rounded-lg hover:bg-yellow-500 transition-colors font-bold"
                        style="font-family: Nunito;">
                        Přejít do košíku
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fullscreen Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center">
    <button id="close-modal" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
        <x-heroicon-o-x-mark class="h-8 w-8" />
    </button>
    
    <button id="prev-modal-image" class="absolute left-4 text-white hover:text-gray-300 transition-colors">
        <x-heroicon-o-chevron-left class="h-12 w-12" />
    </button>
    
    <img id="modal-image" class="max-w-[90vw] max-h-[90vh] object-contain">
    
    <button id="next-modal-image" class="absolute right-4 text-white hover:text-gray-300 transition-colors">
        <x-heroicon-o-chevron-right class="h-12 w-12" />
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const images = @json($product->images);
    let currentIndex = 0;
    const totalImages = images.length;
    
    const mainImage = document.getElementById('main-image');
    const imageCarousel = document.getElementById('image-carousel');
    const nextButton = document.getElementById('next-image');
    const prevButton = document.getElementById('prev-image');
    const thumbnails = document.querySelectorAll('.image-thumbnail');
    
    // Modal elements
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    const closeModal = document.getElementById('close-modal');
    const prevModalImage = document.getElementById('prev-modal-image');
    const nextModalImage = document.getElementById('next-modal-image');
    
    // Update the main image based on the index
    function updateMainImage(index) {
        mainImage.src = '{{ asset('storage') }}/' + images[index];
        
        // Update active thumbnail
        thumbnails.forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.add('ring-2', 'ring-yellow-400');
            } else {
                thumb.classList.remove('ring-2', 'ring-yellow-400');
            }
        });
    }
    
    // Navigate to the next image
    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % totalImages;
        updateMainImage(currentIndex);
    });
    
    // Navigate to the previous image
    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        updateMainImage(currentIndex);
    });
    
    // Thumbnail click functionality
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', function() {
            currentIndex = index;
            updateMainImage(currentIndex);
        });
    });
    
    // Modal functionality - FIX: Add event listener to both the image and the overlay
    mainImage.addEventListener('click', function() {
        openImageModal();
    });
    
    // Also add click handler to the overlay with zoom icon
    const zoomOverlay = document.querySelector('.absolute.inset-0.bg-black');
    if (zoomOverlay) {
        zoomOverlay.addEventListener('click', function() {
            openImageModal();
        });
    }
    
    function openImageModal() {
        modalImage.src = mainImage.src;
        modal.classList.remove('hidden');
    }
    
    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
    
    prevModalImage.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        modalImage.src = '{{ asset('storage') }}/' + images[currentIndex];
        updateMainImage(currentIndex);
    });
    
    nextModalImage.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % totalImages;
        modalImage.src = '{{ asset('storage') }}/' + images[currentIndex];
        updateMainImage(currentIndex);
    });
    
    // Close modal on background click
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
    
    // Quantity input functionality
    const quantityInput = document.getElementById('quantity');
    const incrementButton = document.querySelector('[data-action="increment"]');
    const decrementButton = document.querySelector('[data-action="decrement"]');
    const modalQuantityInput = document.getElementById('modal-quantity');
    const modalQuantityStayInput = document.getElementById('modal-quantity-stay');
    
    incrementButton.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        const maxValue = parseInt(quantityInput.getAttribute('max'));
        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
            if (modalQuantityInput) {
                modalQuantityInput.value = quantityInput.value;
            }
            if (modalQuantityStayInput) {
                modalQuantityStayInput.value = quantityInput.value;
            }
        }
    });
    
    decrementButton.addEventListener('click', function() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            if (modalQuantityInput) {
                modalQuantityInput.value = quantityInput.value;
            }
            if (modalQuantityStayInput) {
                modalQuantityStayInput.value = quantityInput.value;
            }
        }
    });

    // Add a direct event listener to the quantity input to catch manual changes:
    quantityInput.addEventListener('change', function() {
        if (modalQuantityInput) {
            modalQuantityInput.value = this.value;
        }
        if (modalQuantityStayInput) {
            modalQuantityStayInput.value = this.value;
        }
    });
    
    // Rating input functionality
    const ratingInputs = document.querySelectorAll('.rating-input input');
    const starIcons = document.querySelectorAll('.star-icon');
    
    // Fix for star rating hover effect - highlight from left to right
    const ratingLabels = document.querySelectorAll('.rating-input label');
    
    ratingLabels.forEach((label, index) => {
        label.addEventListener('mouseenter', function() {
            // Highlight current star and all stars to the left
            for (let i = 0; i <= index; i++) {
                starIcons[i].classList.add('text-yellow-400');
                starIcons[i].classList.remove('text-gray-300');
            }
            // Remove highlight from stars to the right
            for (let i = index + 1; i < starIcons.length; i++) {
                starIcons[i].classList.remove('text-yellow-400');
                starIcons[i].classList.add('text-gray-300');
            }
        });
    });
    
    // Reset stars when mouse leaves the rating container
    const ratingContainer = document.querySelector('.rating-input');
    if (ratingContainer) {
        ratingContainer.addEventListener('mouseleave', function() {
            // Find the selected rating
            const selectedRating = document.querySelector('.rating-input input:checked');
            if (selectedRating) {
                const selectedIndex = parseInt(selectedRating.value) - 1;
                // Reset stars based on selection
                starIcons.forEach((star, i) => {
                    if (i <= selectedIndex) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            } else {
                // If no rating selected, reset all stars
                starIcons.forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                });
            }
        });
    }
    
    ratingInputs.forEach((input, index) => {
        input.addEventListener('change', function() {
            // Reset all stars
            starIcons.forEach((star, i) => {
                if (i <= index) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        });
    });
});
    
    // Cart confirmation functionality
    function showConfirmationBox(productId) {
        document.getElementById('confirmation-box-' + productId).classList.remove('hidden');
        // Set quantity for both buttons
        const quantity = document.getElementById('quantity').value;
        document.getElementById('modal-quantity').value = quantity;
        document.getElementById('modal-quantity-stay').value = quantity;
    }
    
    // Function to hide the modal (might be needed for other interactions)
    function hideConfirmationBox(productId) {
        const modal = document.getElementById('confirmation-box-' + productId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>

<style>
    /* Custom styles for number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    /* Thumbnail hover effect */
    .image-thumbnail {
        transition: all 0.3s ease;
    }
    
    .image-thumbnail:hover {
        transform: scale(1.05);
    }
    
    /* Star rating hover effect - FIXED to highlight from left to right */
    .rating-input {
        direction: ltr;
    }
    
    /* Remove the previous hover effect that was causing right-to-left highlighting */
    .rating-input label:hover svg,
    .rating-input label:hover ~ label svg {
        color: inherit;
    }
</style>
@endsection
