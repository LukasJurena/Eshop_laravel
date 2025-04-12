@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Banner -->
    <div class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center mb-4 mt-20" style="font-family: BebasNeue;">ČASTÉ DOTAZY</h1>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>
    </div>

        <!-- FAQ Categories -->
        <div class="flex flex-wrap justify-center mt-6 mb-10 gap-4">
            <button class="category-btn active px-6 py-2 rounded-full bg-yellow-400 text-black font-bold transition-all" 
                    style="font-family: Nunito;" data-category="all">
                Všechny
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all" 
                    style="font-family: Nunito;" data-category="orders">
                Objednávky
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all" 
                    style="font-family: Nunito;" data-category="shipping">
                Doprava
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all" 
                    style="font-family: Nunito;" data-category="returns">
                Reklamace
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all" 
                    style="font-family: Nunito;" data-category="contact">
                Kontakt
            </button>
        </div>

        

        <!-- FAQs -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                @php
                    $faqs = [
                        [
                            'question' => 'Jak dlouho trvá zpracování mé žádosti?', 
                            'answer' => 'Zpracování žádosti obvykle trvá 1-2 pracovní dny. Budeme vás informovat e-mailem.',
                            'category' => 'orders',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />'
                        ],
                        [
                            'question' => 'Jak mohu kontaktovat podporu?', 
                            'answer' => 'Podporu můžete kontaktovat prostřednictvím našeho e-mailu <strong>support@firma.cz</strong> nebo telefonicky na čísle <strong>123 456 789</strong>. Jsme k dispozici každý pracovní den od 9:00 do 17:00.',
                            'category' => 'contact',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />'
                        ],
                        [
                            'question' => 'Nabízíte vrácení peněz?', 
                            'answer' => 'Ano, nabízíme vrácení peněz do 30 dnů od zakoupení, pokud nejste s produktem spokojeni. Produkt musí být v původním stavu a v originálním balení. Pro zahájení procesu vrácení peněz nás kontaktujte e-mailem.',
                            'category' => 'returns',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />'
                        ],
                        [
                            'question' => 'Kdy mi bude doručeno objednané zboží?', 
                            'answer' => 'Zboží dorazí většinou do 24 hodin od potvrzení odeslání zboží. Zboží, které je skladem předáváme dopravci obvykle do 24 hodin během pracovních dnů. O každém kroku zpracování vaší objednávky vás budeme informovat e-mailem.',
                            'category' => 'shipping',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />'
                        ],
                        [
                            'question' => 'Zasíláte i na Slovensko?', 
                            'answer' => 'Ano. Pokud nepřesáhne internetová objednávka nad 3 000 Kč bez DPH (200 EUR), bude připočítán manipulační poplatek (poštovné) podle platného ceníku PPL, který je součástí obchodních podmínek. Doručení na Slovensko obvykle trvá 2-3 pracovní dny.',
                            'category' => 'shipping',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
                        ],
                        [
                            'question' => 'Jak mohu reklamovat zboží?', 
                            'answer' => 'Reklamační řízení může být zahájeno, jestliže zákazník předloží kompletní reklamové zboží, prokáže nákup reklamovaného zboží dokladem o nákupu (prodejkou, fakturou) a doloží vyplněný reklamační list. Reklamaci můžete podat osobně na naší prodejně nebo zaslat poštou s přiloženým reklamačním listem.',
                            'category' => 'returns',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />'
                        ],
                        [
                            'question' => 'Jaké platební metody přijímáte?', 
                            'answer' => 'Přijímáme platby kartou (Visa, Mastercard), bankovním převodem, dobírkou a online platebními metodami jako je Apple Pay, Google Pay a PayPal. Všechny online platby jsou zabezpečené a šifrované.',
                            'category' => 'orders',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />'
                        ],
                        [
                            'question' => 'Mohu změnit nebo zrušit svou objednávku?', 
                            'answer' => 'Objednávku můžete změnit nebo zrušit do 1 hodiny od jejího odeslání. Kontaktujte nás co nejdříve e-mailem nebo telefonicky. Pokud již byla objednávka zpracována, nemusí být možné ji změnit nebo zrušit.',
                            'category' => 'orders',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />'
                        ],
                    ];
                @endphp

                <div class="divide-y divide-gray-200">
                    @foreach ($faqs as $index => $faq)
                        <div class="faq-item" data-category="{{ $faq['category'] }}">
                            <button class="w-full text-left px-6 py-4 focus:outline-none transition-colors hover:bg-gray-50 flex items-center justify-between"
                                    onclick="toggleFaq({{ $index }})">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 mr-3 flex-shrink-0 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            {!! $faq['icon'] !!}
                                        </svg>
                                    </div>
                                    <span class="text-lg font-semibold" style="font-family: Nunito;">{{ $faq['question'] }}</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="faq-icon h-5 w-5 text-yellow-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                            <div class="faq-answer overflow-hidden max-h-0 transition-all duration-300 ease-in-out bg-gray-50">
                                <div class="p-6 border-t border-gray-100">
                                    <p class="text-gray-700" style="font-family: NunitoLight;">{!! $faq['answer'] !!}</p>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Still Have Questions -->
            <div class="mt-12 bg-black text-white rounded-2xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4" style="font-family: BebasNeue;">NENAŠLI JSTE ODPOVĚĎ?</h3>
                <p class="mb-6" style="font-family: NunitoLight;">Kontaktujte nás a my vám rádi pomůžeme s jakýmkoli dotazem.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="mailto:info@skateshop.cz" class="inline-flex items-center justify-center bg-yellow-400 text-black px-6 py-3 rounded-lg hover:bg-yellow-500 transition-colors" style="font-family: Nunito;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Poslat e-mail
                    </a>
                    <a href="tel:+420123456789" class="inline-flex items-center justify-center bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors" style="font-family: Nunito;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +420 123 456 789
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle Function
    window.toggleFaq = function(index) {
        const allAnswers = document.querySelectorAll('.faq-answer');
        const allIcons = document.querySelectorAll('.faq-icon');
        const currentAnswer = allAnswers[index];
        const currentIcon = allIcons[index];
        
        // Check if this FAQ is already open
        const isOpen = currentAnswer.classList.contains('active');
        
        // Close all FAQs
        allAnswers.forEach(answer => {
            answer.style.maxHeight = '0px';
            answer.classList.remove('active');
        });
        
        allIcons.forEach(icon => {
            icon.classList.remove('rotate-45');
        });
        
        // If the clicked FAQ wasn't open, open it
        if (!isOpen) {
            currentAnswer.style.maxHeight = currentAnswer.scrollHeight + 'px';
            currentAnswer.classList.add('active');
            currentIcon.classList.add('rotate-45');
        }
    };
    
    // Category Filter
    const categoryButtons = document.querySelectorAll('.category-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            categoryButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-yellow-400', 'text-black');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            button.classList.add('active', 'bg-yellow-400', 'text-black');
            button.classList.remove('bg-gray-200', 'text-gray-700');
            
            const category = button.getAttribute('data-category');
            
            // Show/hide FAQ items based on category
            faqItems.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('faq-search');
    
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        
        faqItems.forEach(item => {
            const question = item.querySelector('button span').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
        
        // Reset category buttons
        categoryButtons.forEach(btn => {
            btn.classList.remove('active', 'bg-yellow-400', 'text-black');
            btn.classList.add('bg-gray-200', 'text-gray-700');
        });
        
        // Set "All" as active
        categoryButtons[0].classList.add('active', 'bg-yellow-400', 'text-black');
        categoryButtons[0].classList.remove('bg-gray-200', 'text-gray-700');
    });
});
</script>

<style>
/* Smooth transitions for FAQ answers */
.faq-answer {
    transition: max-height 0.5s ease, opacity 0.3s ease;
}

/* Category button active state */
.category-btn.active {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Hover effect for FAQ items */
.faq-item button:hover {
    background-color: #FEFAF0;
}
</style>
@endsection
