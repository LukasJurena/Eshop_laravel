@extends('layouts.app')

@section('content')
<!-- Hero Section Fullscreen Split Left-Right -->
<div class="min-h-screen bg-black text-white flex items-center">
    <div class="w-full flex flex-col md:flex-row items-center justify-between">
        <!-- Levá část: Text -->
        <div class="w-full md:w-1/2 text-center md:text-left flex justify-center md:justify-start items-center" style="font-family: Nunito;">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6" style="font-family: BebasNeue;">
                    Nová Kolekce 2025
                </h1>
                <p class="text-lg md:text-xl mb-8" style="font-family: NunitoLight;">
                    Styl. Rychlost. Svoboda. Projeď se s námi ve stylu nové generace.
                </p>
                <a href="/products" class="inline-block bg-yellow-400 text-black font-semibold py-3 px-6 rounded-lg hover:bg-yellow-300 transition">
                    Prohlédnout kolekci
                </a>
            </div>
        </div>

        <!-- Pravá část: Obrázek -->
        <div class="w-full md:w-1/2 h-full mt-10 md:mt-0">
            <img src="{{ asset('images/skate-hero.png') }}" alt="Skater"
                class="w-full h-full object-cover">
        </div>
    </div>
</div>

    @livewire('gallery')

<!-- Why Choose Us Section -->
<div class="py-10 text-center bg-gray-100" style="font-family: NunitoLight;">
    <h2 class="text-3xl font-semibold text-gray-900">Proč nakupovat u nás?</h2>
    <p class="mt-4 text-lg text-gray-700">Nabízíme nejlepší produkty za nejlepší ceny!</p>
    <div class="mt-6 flex flex-wrap justify-center gap-6">
        <!-- Rychlá Doprava -->
        <div class="card bg-white shadow-xl rounded-lg p-6 max-w-xs transform transition-transform duration-300 ease-in-out hover:scale-105 hover:bg-yellow-100 hover:shadow-2xl hover:rotate-3">
            <div class="flex justify-center">
                <x-heroicon-o-truck class="h-16 w-16 text-yellow-500" />
            </div>
            <h3 class="text-lg font-bold mt-4" style="font-family: Nunito;">Rychlá Doprava</h3>
            <p class="mt-2 text-gray-600" style="font-family: Nunito-Light;">Zaručujeme rychlé dodání vašich objednávek.</p>
        </div>

        <!-- Kvalitní Produkty -->
        <div class="card bg-white shadow-xl rounded-lg p-6 max-w-xs transform transition-transform duration-300 ease-in-out hover:scale-105 hover:bg-yellow-100 hover:shadow-2xl hover:rotate-3">
            <div class="flex justify-center">
                <x-iconsax-bro-sidebar-right class="h-16 w-16 text-yellow-500" />
            </div>
            <h3 class="text-lg font-bold mt-4" style="font-family: Nunito;">Kvalitní Produkty</h3>
            <p class="mt-2 text-gray-600" style="font-family: Nunito-Light;">Naše produkty procházejí důkladným výběrem kvality.</p>
        </div>

        <!-- Zákaznická Podpora -->
        <div class="card bg-white shadow-xl rounded-lg p-6 max-w-xs transform transition-transform duration-300 ease-in-out hover:scale-105 hover:bg-yellow-100 hover:shadow-2xl hover:rotate-3">
            <div class="flex justify-center">
                <x-gmdi-support-agent-o class="h-16 w-16 text-yellow-500" />
            </div>
            <h3 class="text-lg font-bold mt-4" style="font-family: Nunito;">Zákaznická Podpora</h3>
            <p class="mt-2 text-gray-600" style="font-family: NunitoLight;">Jsme tu pro vás, abychom zodpověděli všechny vaše dotazy.</p>
        </div>
    </div>
</div>

<!-- JavaScript pro 3D efekt pouze na kartě -->
<script>
    // Funkce pro pohyb myši nad kartou
    function initCardMovement() {
        const cards = document.querySelectorAll('.card');
        
        cards.forEach(card => {
            let frameRequested = false;

            // Při pohybu myši nad kartou
            card.addEventListener('mousemove', (e) => {
                if (!frameRequested) {
                    requestAnimationFrame(() => {
                        const { clientX: mouseX, clientY: mouseY } = e;
                        const { offsetLeft: cardX, offsetTop: cardY, offsetWidth: cardWidth, offsetHeight: cardHeight } = card;
                        const cardCenterX = cardX + cardWidth / 2;
                        const cardCenterY = cardY + cardHeight / 2;

                        const deltaX = (mouseX - cardCenterX) / 35; // Úprava citlivosti rotace
                        const deltaY = (mouseY - cardCenterY) / 35;

                        card.style.transition = 'transform 0.1s ease-out'; // Hladký přechod při pohybu
                        card.style.transform = `perspective(1200px) rotateX(${deltaY}deg) rotateY(${deltaX}deg)`;
                        frameRequested = false;
                    });
                    frameRequested = true;
                }
            });

            // Když myš opustí kartu
            card.addEventListener('mouseleave', () => {
                card.style.transition = 'transform 0.3s ease-in-out'; // Plynulý návrat
                card.style.transform = 'perspective(1200px) rotateX(0deg) rotateY(0deg)';
            });
        });
    }

    // Inicializace efektu při načítání stránky
    document.addEventListener('DOMContentLoaded', initCardMovement);
</script>


    <!-- Reviews Section (Now under the slider) -->
    @include('components.model-viewer')
    @include('components.reviews')
    @include('components.product-slider')
@endsection

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
            },
            loop: true,
        });
    </script>
@endpush
