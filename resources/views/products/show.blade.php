@extends('layouts.app')

@section('content')
<div class="container mt-20 px-4 sm:px-6 lg:px-8 mx-auto relative top-11">
    <!-- Back Button (Přesunuto doleva nahoře) -->
    <div class="fixed left-6 z-50" style="top: 5rem;">
    <a href="{{ route('products.index') }}" class="btn btn-secondary bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md">
        Back to Products
    </a>
</div>

    <div class="product-details bg-white p-6 shadow-lg rounded-lg mx-auto w-full lg:w-4/5 flex justify-between">
        <!-- Product Image Section -->
        <div class="flex">
            <!-- Product Image Section -->
            <div class="w-full lg:w-1/2 pr-4">
                <!-- Main Image (clickable square) -->
                <div class="main-image mb-6">
                    @if (!empty($product->images))
                    <img id="main-image" src="{{ asset('storage/' . $product->images[0]) }}"
                        alt="{{ $product->name }}"
                        class="product-image mx-auto object-cover rounded-lg"
                        style="width: 300px; height: 300px; cursor: pointer;">
                    @endif
                </div>

                <!-- Additional Product Images (Carousel) -->
                <div class="flex justify-between mt-4 relative">
                    <button id="prev-image" class="prev-arrow absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full">
                        &lt;
                    </button>
                    <div class="overflow-hidden w-full">
                        <div class="flex transition-transform duration-300" id="image-carousel">
                            @foreach ($product->images as $index => $image)
                            <img src="{{ asset('storage/' . $image) }}"
                                alt="{{ $product->name }}"
                                class="rounded-lg cursor-pointer image-thumbnail"
                                data-index="{{ $index }}"
                                style="width: 80px; height: 80px; object-fit: cover; max-width: 80px; max-height: 80px;">
                            @endforeach
                        </div>
                    </div>
                    <button id="next-image" class="next-arrow absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full">
                        &gt;
                    </button>
                </div>
            </div>

            <!-- Modal for Fullscreen Image View -->
            <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50 hidden">
                <div class="relative flex items-center">
                    <!-- Obrázek -->
                    <img id="modal-image" class="max-w-full max-h-full object-contain">
                    <!-- Křížek vedle obrázku -->
                    <span id="close-modal" class="absolute top-0 right-0 text-white text-3xl cursor-pointer">
                        &times;
                    </span>
                </div>
            </div>

            <script>
                const images = @json($product->images); // All product images from the backend
                let currentIndex = 0; // Start with the first image
                const totalImages = images.length;

                const mainImage = document.getElementById('main-image');
                const imageCarousel = document.getElementById('image-carousel');
                const nextButton = document.getElementById('next-image');
                const prevButton = document.getElementById('prev-image');

                // Update the main image based on the index
                function updateMainImage(index) {
                    mainImage.src = '{{ asset('storage') }}/' + images[index]; // Correct the image path concatenation
                }

                // Navigate to the next image
                nextButton.addEventListener('click', function() {
                    if (currentIndex < totalImages - 1) {
                        currentIndex++;
                    } else {
                        currentIndex = 0; // Loop back to the first image
                    }
                    updateMainImage(currentIndex);
                    updateCarouselPosition();
                });

                // Navigate to the previous image
                prevButton.addEventListener('click', function() {
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = totalImages - 1; // Loop back to the last image
                    }
                    updateMainImage(currentIndex);
                    updateCarouselPosition();
                });

                // Update the position of the carousel based on currentIndex
                function updateCarouselPosition() {
                    const offset = -currentIndex * 80; // Shift the carousel by 80px for each image
                    imageCarousel.style.transform = `translateX(${offset}px)`;
                }

                // Thumbnail image click functionality
                const thumbnails = document.querySelectorAll('.image-thumbnail');
                thumbnails.forEach((thumbnail) => {
                    thumbnail.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        currentIndex = index;
                        updateMainImage(currentIndex);
                        updateCarouselPosition();
                    });
                });

                // Modal functionality to display clicked image in fullscreen
                const modal = document.getElementById('image-modal');
                const modalImage = document.getElementById('modal-image');
                const closeModal = document.getElementById('close-modal');

                // Show the modal with the clicked image
                mainImage.addEventListener('click', function() {
                    const imageUrl = this.src;
                    modalImage.src = imageUrl;
                    modal.classList.remove('hidden');
                });

                // Close the modal when user clicks on close button
                closeModal.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });

                // Close the modal if user clicks outside the image
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            </script>

            <style>
                /* Pevná pozice pro šipky */
                .prev-arrow,
                .next-arrow {
                    width: 40px;
                    height: 40px;
                    background-color: rgba(0, 0, 0, 0.5);
                    color: white;
                    font-size: 24px;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    z-index: 10;
                }

                /* Umístění šipek do správné pozice */
                .prev-arrow {
                    left: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                }

                .next-arrow {
                    right: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                }

                /* Styl pro carousel */
                #image-carousel {
                    display: flex;
                    gap: 10px;
                    /* Mezery mezi obrázky */
                }

                /* Zajištění, že obrázky mají pevnou velikost */
                .image-thumbnail {
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    max-width: 80px;
                    max-height: 80px;
                    cursor: pointer;
                    transition: transform 0.3s ease;
                }

                /* Zvětšení obrázků při najetí kurzoru */
                .image-thumbnail:hover {
                    transform: scale(1.1);
                }

                /* Hlavní obrázek - bude mít pevné rozměry */
                .product-image {
                    width: 300px;
                    height: 300px;
                    object-fit: cover;
                    cursor: pointer;
                }

                /* Modal pro zobrazení obrázku */
                #image-modal {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 100;
                    background-color: rgba(0, 0, 0, 0.5);
                }

                #modal-image {
                    min-width: 30vw;
                    /* Minimální šířka obrázku - 30% šířky obrazovky */
                    min-height: 30vh;
                    /* Minimální výška obrázku - 30% výšky obrazovky */
                    max-width: 90vw;
                    /* Maximální šířka obrázku - 100% šířky obrazovky */
                    max-height: 90vh;
                    /* Maximální výška obrázku - 100% výšky obrazovky */
                    object-fit: contain;
                    /* Udržuje poměr stran při zvětšení */
                }

                #image-modal.hidden {
                    display: none;
                }

                #close-modal {
                    position: absolute;
                    top: 0;
                    right: -40px;
                    /* Posuneme křížek mimo obrázek, aby byl vedle něj */
                    color: white;
                    font-size: 30px;
                    cursor: pointer;
                    z-index: 101;
                    /* Křížek bude nad obrázkem */
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

            <!-- Product Information Section -->
            <div class="w-full lg:w-1/2 pl-4 flex justify-end">
        <div class="text-right w-full max-w-lg">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 mb-4">{{ $product->description }}</p>
            <div class="flex justify-end text-lg font-medium text-gray-800">
                <p><strong>Price: </strong>{{ $product->price }} Kč</p>
                <p><strong>SKU: </strong>{{ $product->sku }}</p>
            </div>
            <div class="flex justify-end text-lg font-medium text-gray-800 mt-2">
                <p><strong>In Stock: </strong>{{ $product->in_stock }}</p>
                <p>
                    Hodnocení: <strong>{{ number_format($product->averageRating(), 1) }} ⭐</strong>
                    <span class="text-gray-400">({{ $product->reviews->count() }}x)</span>
                </p>
            </div>
            <button type="button" class="inline-block px-6 py-2 mt-2 text-white bg-green-500 rounded-md hover:bg-green-600 transition" onclick="showConfirmationBox({{ $product->id }})">Přidat do košíku</button>
        </div>
    </div>
    
</div>
        </div>
    </div>
        <div class="p-8 m-8">
            <div class="mt-8 p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Customer Reviews</h2>

                <!-- Výpis recenzí -->
                @if($product->reviews->count() > 0)
                @foreach($product->reviews as $review)
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <p class="text-lg font-semibold">{{ $review->user->name ?? 'Neznámý uživatel' }}</p>
                    <p class="text-yellow-500">⭐ {{ $review->rating }} / 5</p>
                    <p class="text-gray-700">{{ $review->comment }}</p>
                </div>
                @endforeach
                @else
                <p class="text-gray-500">No reviews yet. Be the first to review this product!</p>
                @endif

                <!-- Formulář pro přidání recenze -->
                <!-- Formulář pro přidání recenze -->
                @auth
                <!-- Check if the user has already reviewed this product -->
                @php
                $existingReview = $product->reviews->where('user_id', Auth::id())->first();
                @endphp

                @if($existingReview)
                <p class="text-lg font-semibold text-gray-600">You have already reviewed this product. Thank you!</p>
                @else
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Add a Review</h3>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-4">
                            <label for="rating" class="block text-lg font-medium text-gray-700">Rating</label>
                            <select name="rating" id="rating" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="5">⭐️⭐️⭐️⭐️⭐️ - Excellent</option>
                                <option value="4">⭐️⭐️⭐️⭐️ - Good</option>
                                <option value="3">⭐️⭐️⭐️ - Average</option>
                                <option value="2">⭐️⭐️ - Poor</option>
                                <option value="1">⭐️ - Terrible</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-lg font-medium text-gray-700">Comment</label>
                            <textarea name="comment" id="comment" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600">
                            Submit Review
                        </button>
                    </form>
                </div>
                @endif
                @else
                <p class="mt-4 text-gray-500">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in</a> to leave a review.
                </p>
                @endauth
            </div>
            <x-infinite_slider :products="$relatedProducts" />

        </div>
</div>
<!-- Confirmation Box -->
<!-- Confirmation Box -->
<div id="confirmation-box-{{ $product->id }}" class="confirmation-box">
    <p>Chcete zůstat na stránce nebo přejít do košíku?</p>
    <div class="btn-container">
        <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="stay" value="true">
            <button type="submit" class="btn" onclick="hideConfirmationBox({{ $product->id }})">Zůstat na stránce</button>
        </form>
        <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="stay" value="false">
            <button type="submit" class="btn">Přejít do košíku</button>
        </form>
    </div>
</div>

</div>

<script>
function showConfirmationBox(productId) {
    document.getElementById('confirmation-box-' + productId).style.display = 'block';
}

function hideConfirmationBox(productId) {
    document.getElementById('confirmation-box-' + productId).style.display = 'none';
}
</script>
@endsection