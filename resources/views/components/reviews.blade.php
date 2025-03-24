<!-- resources/views/components/reviews.blade.php -->
<div class="reviews-container bg-gray-50 py-10">
    <h2 class="text-3xl font-semibold text-center mb-6">Co o nás říkají naši zákazníci</h2>

    <!-- Flex container pro čtyři sloupce -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Left Column - First Review -->
        <div class="flex flex-col gap-6">
            <div class="review bg-white p-4 shadow-md rounded-lg w-full overflow-hidden transform transition-all duration-500 hover:h-auto hover:shadow-xl hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    <div>
                        <h4 class="font-semibold text-lg">Luky Puky</h4>
                        <p class="text-gray-500">Leden 18, 2025</p>
                    </div>
                </div>
                <div class="flex mb-2 stars-only">
                    <span class="text-yellow-500">★★★★★</span>
                </div>
                <div class="review-text text-gray-600 opacity-0 max-h-0 overflow-hidden transition-all duration-500">
                    <p>"Skvélé produkty a velmi rychlé dodání! Určitě se vrátím na další nákup!"</p>
                </div>
            </div>
        </div>

        <!-- Left Column - Second Review -->
        <div class="flex flex-col gap-6">
            <div class="review bg-white p-4 shadow-md rounded-lg w-full overflow-hidden transform transition-all duration-500 hover:h-auto hover:shadow-xl hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    <div>
                        <h4 class="font-semibold text-lg">Petr Vyskoč</h4>
                        <p class="text-gray-500">Září 17, 2025</p>
                    </div>
                </div>
                <div class="flex mb-2 stars-only">
                    <span class="text-yellow-500">★★★★☆</span>
                </div>
                <div class="review-text text-gray-600 opacity-0 max-h-0 overflow-hidden transition-all duration-500">
                    <p>"Kvalita produktů je výborná. Doporučuji každému, kdo hledá kvalitní zboží za dobrou cenu!"</p>
                </div>
            </div>
        </div>

        <!-- Right Column - Third Review -->
        <div class="flex flex-col gap-6">
            <div class="review bg-white p-4 shadow-md rounded-lg w-full overflow-hidden transform transition-all duration-500 hover:h-auto hover:shadow-xl hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    <div>
                        <h4 class="font-semibold text-lg">Radoš Gremlinský</h4>
                        <p class="text-gray-500">Květen 16, 2025</p>
                    </div>
                </div>
                <div class="flex mb-2 stars-only">
                    <span class="text-yellow-500">★★★★★</span>
                </div>
                <div class="review-text text-gray-600 opacity-0 max-h-0 overflow-hidden transition-all duration-500">
                    <p>"Skvělý obchod! Produkty jsou kvalitní, ceny jsou příznivé a zákaznická podpora je na vysoké úrovni. Určitě se sem vrátím!"</p>
                </div>
            </div>
        </div>

        <!-- Right Column - Fourth Review -->
        <div class="flex flex-col gap-6">
            <div class="review bg-white p-4 shadow-md rounded-lg w-full overflow-hidden transform transition-all duration-500 hover:h-auto hover:shadow-xl hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-4"></div>
                    <div>
                        <h4 class="font-semibold text-lg">Metr Párna</h4>
                        <p class="text-gray-500">Únor 21, 2025</p>
                    </div>
                </div>
                <div class="flex mb-2 stars-only">
                    <span class="text-yellow-500">★★★★★</span>
                </div>
                <div class="review-text text-gray-600 opacity-0 max-h-0 overflow-hidden transition-all duration-500">
                    <p>"Velmi spokojen s nákupem, rychlé dodání a přehledná stránka. Doporučuji!"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Rating (Optional) -->
    <div class="text-center mt-8">
        <p class="text-xl font-semibold">Průměrné hodnocení: 4.8/5</p>
    </div>
</div>

<!-- Add JavaScript for hover effect -->
<script>
    document.querySelectorAll('.review').forEach(review => {
        review.addEventListener('mouseenter', () => {
            const reviewText = review.querySelector('.review-text');
            reviewText.style.opacity = '1';
            reviewText.style.maxHeight = '1000px'; // Allow it to expand
        });

        review.addEventListener('mouseleave', () => {
            const reviewText = review.querySelector('.review-text');
            reviewText.style.opacity = '0';
            reviewText.style.maxHeight = '0'; // Collapse the text
        });
    });
</script>