@php
$reviews = [
    [
        'author' => 'Luky Puky',
        'date' => 'Leden 18, 2025',
        'rating' => 5,
        'text' => 'Skvélé produkty a velmi rychlé dodání! Určitě se vrátím na další nákup!',
        'avatar' => 'user1.jpg' // Optional: you can add actual avatar images
    ],
    [
        'author' => 'Petr Vyskoč',
        'date' => 'Září 17, 2025',
        'rating' => 4,
        'text' => 'Kvalita produktů je výborná. Doporučuji každému, kdo hledá kvalitní zboží za dobrou cenu!',
        'avatar' => 'user2.jpg'
    ],
    [
        'author' => 'Radoš Gremlinský',
        'date' => 'Květen 16, 2025',
        'rating' => 5,
        'text' => 'Skvělý obchod! Produkty jsou kvalitní, ceny jsou příznivé a zákaznická podpora je na vysoké úrovni. Určitě se sem vrátím!',
        'avatar' => 'user3.jpg'
    ],
    [
        'author' => 'Metr Párna',
        'date' => 'Únor 21, 2025',
        'rating' => 5,
        'text' => 'Velmi spokojen s nákupem, rychlé dodání a přehledná stránka. Doporučuji!',
        'avatar' => 'user4.jpg'
    ],
    [
        'author' => 'Jana Nováková',
        'date' => 'Březen 5, 2025',
        'rating' => 5,
        'text' => 'Naprostá spokojenost! Objednávka dorazila rychle a vše bylo perfektně zabaleno.',
        'avatar' => 'user5.jpg'
    ],
    [
        'author' => 'Martin Svoboda',
        'date' => 'Duben 12, 2025',
        'rating' => 4,
        'text' => 'Skvělý výběr produktů a příjemná komunikace. Jen dodání trvalo o něco déle.',
        'avatar' => 'user6.jpg'
    ],
];

// Calculate average rating
$totalRating = 0;
foreach ($reviews as $review) {
    $totalRating += $review['rating'];
}
$averageRating = number_format($totalRating / count($reviews), 1);
@endphp

<section class="reviews-section py-16 bg-gray-50 overflow-hidden">
    <div class="">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4" style="font-family: BebasNeue, sans-serif;">CO O NÁS ŘÍKAJÍ ZÁKAZNÍCI</h2>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>

        <!-- Infinite Scroll Reviews -->
        <div class="reviews-carousel relative">
            <!-- First set of reviews -->
            <div class="reviews-track flex animate-scroll">
                @foreach ($reviews as $review)
                <div class="review-card flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full transform transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4 overflow-hidden">
                                    @if (isset($review['avatar']))
                                        <img src="{{ asset('images/avatars/' . $review['avatar']) }}" alt="{{ $review['author'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg" style="font-family: Nunito, sans-serif;">{{ $review['author'] }}</h3>
                                    <p class="text-gray-500 text-sm" style="font-family: NunitoLight, sans-serif;">{{ $review['date'] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review['rating'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            
                            <div class="review-content">
                                <p class="text-gray-600" style="font-family: NunitoLight, sans-serif;">"{{ $review['text'] }}"</p>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-gray-500" style="font-family: NunitoLight, sans-serif;">Ověřený nákup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Duplicate the reviews for infinite scrolling -->
                @foreach ($reviews as $review)
                <div class="review-card flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full transform transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4 overflow-hidden">
                                    @if (isset($review['avatar']))
                                        <img src="{{ asset('images/avatars/' . $review['avatar']) }}" alt="{{ $review['author'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg" style="font-family: Nunito, sans-serif;">{{ $review['author'] }}</h3>
                                    <p class="text-gray-500 text-sm" style="font-family: NunitoLight, sans-serif;">{{ $review['date'] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review['rating'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            
                            <div class="review-content">
                                <p class="text-gray-600" style="font-family: NunitoLight, sans-serif;">"{{ $review['text'] }}"</p>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-gray-500" style="font-family: NunitoLight, sans-serif;">Ověřený nákup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Average Rating -->
        <div class="mt-12 text-center">
            <div class="inline-flex items-center bg-white px-6 py-3 rounded-full shadow-md">
                <div class="flex mr-3">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @elseif ($i - $averageRating > 0 && $i - $averageRating < 1)
                            <div class="relative w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 absolute" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <div class="absolute overflow-hidden" style="width: {{ ($averageRating - floor($averageRating)) * 100 }}%">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                            </div>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endif
                    @endfor
                </div>
                <span class="text-xl font-bold" style="font-family: Nunito, sans-serif;">{{ $averageRating }}/5</span>
                <span class="ml-2 text-gray-500" style="font-family: NunitoLight, sans-serif;">z {{ count($reviews) }} hodnocení</span>
            </div>
        </div>
        
        <!-- Call to Action 
        <div class="mt-8 text-center">
            <a href="/reviews" class="inline-flex items-center px-6 py-3 bg-yellow-400 text-black font-semibold rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                <span>Zobrazit všechna hodnocení</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>-->
    </div>
</section>

<style>
    /* Infinite scroll animation */
    .reviews-carousel {
        overflow: hidden;
        position: relative;
        padding: 1rem 0;
    }
    
    .reviews-track {
        width: fit-content;
        animation: scrollReviews 60s linear infinite;
    }
    
    @keyframes scrollReviews {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%); /* Move exactly half the width for seamless loop */
        }
    }
    
    /* Pause animation on hover */
    .reviews-carousel:hover .reviews-track {
        animation-play-state: paused;
    }
    
    /* Add gradient fade effect on sides */
    .reviews-carousel::before,
    .reviews-carousel::after {
        content: "";
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }
    
    .reviews-carousel::before {
        left: 0;
        background: linear-gradient(to right, rgba(249, 250, 251, 1), rgba(249, 250, 251, 0));
    }
    
    .reviews-carousel::after {
        right: 0;
        background: linear-gradient(to left, rgba(249, 250, 251, 1), rgba(249, 250, 251, 0));
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .reviews-carousel::before,
        .reviews-carousel::after {
            width: 50px;
        }
    }
    
    /* Add subtle hover effect */
    .review-card:hover {
        z-index: 10;
    }
    
    /* Add animation for verified badge */
    .review-card:hover svg {
        transform: scale(1.2);
        transition: transform 0.3s ease;
    }
</style>