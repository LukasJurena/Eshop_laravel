@extends('layouts.app')

@section('content')
<div class="h-20"> </div>
<div class="container mx-auto py-10">
    <h1 class="text-5xl font-semibold text-center mb-8 text-white">Časté dotazy</h1>
    <div class="space-y-6">
        <!-- První dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Jak dlouho trvá zpracování mé žádosti?
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Zpracování žádosti obvykle trvá 1-2 pracovní dny. Budeme vás informovat e-mailem.
            </div>
        </div>

        <!-- Druhý dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Jak mohu kontaktovat podporu?
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Podporu můžete kontaktovat prostřednictvím našeho e-mailu support@firma.cz nebo telefonicky na čísle 123 456 789.
            </div>
        </div>

        <!-- Třetí dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Nabízíte vrácení peněz?
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Ano, nabízíme vrácení peněz do 30 dnů od zakoupení, pokud nejste s produktem spokojeni.
            </div>
        </div>

        <!-- 4 dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Kdy mi bude doručeno objednané zboží?
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Zboží dorazí většinou do 24 hodin od potvrzení odeslání zboží. Zboží, které je skladem předáváme dopravci obvykle do 24 hodin během pracovních dnů.
            </div>
        </div>

        <!-- 5 dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Zasíláte i na Slovensko?
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Ano. Pokud nepřesáhne internetová objednávka nad 3 000 Kč bez DPH (200 EUR), bude připočítán manipulační poplatek (poštovné) podle platného ceníku PPL, který je součástí obchodních podmínek.
            </div>
        </div>

        <!-- 6 dotaz -->
        <div>
            <button class="w-full text-left text-xl font-medium text-white bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                    onclick="toggleAnswer(this)">
                Reklamace
                <span class="ml-4">+</span>
            </button>
            <div class="answer hidden mt-2 text-gray-700 px-6">
                Reklamační řízení může být zahájeno, jestliže zákazník předloží kompletní reklamové zboží, prokáže nákup reklamovaného zboží dokladem o nákupu (prodejkou, fakturou) a doloží vyplněný list.
            </div>
        </div>
    </div>
</div>

<style>
    .answer {
        height: 0;
        overflow: hidden;
        opacity: 0;
        transition: height 0.5s ease, opacity 0.5s ease;
    }

    .answer.show {
        height: auto; /* Automatická výška podle obsahu */
        opacity: 1;
    }
</style>
<style>
/* Animace pro zobrazení odpovědi */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Skrytí odpovědi */


/* Zobrazení odpovědi s animací */
.show {
    display: block;
    animation: fadeIn 0.5s ease-out;
}
</style>



<script>
function toggleAnswer(button) {
    const answer = button.nextElementSibling;
    const isHidden = answer.classList.contains('hidden');
    
    // Toggle visibility with animation
    answer.classList.toggle('hidden');
    answer.classList.toggle('show');
    button.querySelector('span').textContent = isHidden ? '−' : '+';
}
</script>

@endsection