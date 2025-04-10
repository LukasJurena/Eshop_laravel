<!-- resources/views/components/why-choose-us.blade.php -->

<section class="py-16 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-gray-900 mb-4">Proč nakupovat u nás?</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Nabízíme nejlepší produkty za nejlepší ceny!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Rychlá Doprava --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 group-hover:-translate-y-2">
                    <div class="flex justify-center items-center w-20 h-20 bg-yellow-100 rounded-full mb-6">
                        <x-heroicon-o-truck class="h-10 w-10 text-yellow-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rychlá Doprava</h3>
                    <p class="text-gray-600 text-center">Zaručujeme rychlé dodání vašich objednávek.</p>
                </div>
                <div class="h-1 w-0 bg-yellow-400 mt-6 mx-auto transition-all duration-300 group-hover:w-1/2"></div>
            </div>

            {{-- Kvalitní Produkty --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 group-hover:-translate-y-2">
                    <div class="flex justify-center items-center w-20 h-20 bg-yellow-100 rounded-full mb-6">
                        <x-heroicon-o-academic-cap class="h-10 w-10 text-yellow-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kvalitní Produkty</h3>
                    <p class="text-gray-600 text-center">Naše produkty procházejí důkladným výběrem kvality.</p>
                </div>
                <div class="h-1 w-0 bg-yellow-400 mt-6 mx-auto transition-all duration-300 group-hover:w-1/2"></div>
            </div>

            {{-- Zákaznická Podpora --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 group-hover:-translate-y-2">
                    <div class="flex justify-center items-center w-20 h-20 bg-yellow-100 rounded-full mb-6">
                        <x-heroicon-o-chat-bubble-bottom-center class="h-10 w-10 text-yellow-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Zákaznická Podpora</h3>
                    <p class="text-gray-600 text-center">Jsme tu pro vás, abychom zodpověděli všechny vaše dotazy.</p>
                </div>
                <div class="h-1 w-0 bg-yellow-400 mt-6 mx-auto transition-all duration-300 group-hover:w-1/2"></div>
            </div>
        </div>
    </div>
</section>