@extends('layouts.app')

@section('content')
<div class="h-20"> </div>
<div class="container mx-auto py-10">
    <h1 class="text-5xl text-center mb-8 text-black" style="font-family: BebasNeue;">Časté dotazy</h1>
    <div class="space-y-6">
        @php
            $faqs = [
                ['question' => 'Jak dlouho trvá zpracování mé žádosti?', 'answer' => 'Zpracování žádosti obvykle trvá 1-2 pracovní dny. Budeme vás informovat e-mailem.'],
                ['question' => 'Jak mohu kontaktovat podporu?', 'answer' => 'Podporu můžete kontaktovat prostřednictvím našeho e-mailu support@firma.cz nebo telefonicky na čísle 123 456 789.'],
                ['question' => 'Nabízíte vrácení peněz?', 'answer' => 'Ano, nabízíme vrácení peněz do 30 dnů od zakoupení, pokud nejste s produktem spokojeni.'],
                ['question' => 'Kdy mi bude doručeno objednané zboží?', 'answer' => 'Zboží dorazí většinou do 24 hodin od potvrzení odeslání zboží. Zboží, které je skladem předáváme dopravci obvykle do 24 hodin během pracovních dnů.'],
                ['question' => 'Zasíláte i na Slovensko?', 'answer' => 'Ano. Pokud nepřesáhne internetová objednávka nad 3 000 Kč bez DPH (200 EUR), bude připočítán manipulační poplatek (poštovné) podle platného ceníku PPL, který je součástí obchodních podmínek.'],
                ['question' => 'Reklamace', 'answer' => 'Reklamační řízení může být zahájeno, jestliže zákazník předloží kompletní reklamové zboží, prokáže nákup reklamovaného zboží dokladem o nákupu (prodejkou, fakturou) a doloží vyplněný list.'],
            ];
        @endphp

        @foreach ($faqs as $faq)
            <div>
                <button class="w-full text-left text-xl font-medium text-black bg-gray-700 px-6 py-4 rounded-lg flex justify-between items-center"
                        onclick="toggleAnswer(this)">
                    {{ $faq['question'] }}
                    <span class="ml-4">+</span>
                </button>
                <div class="answer hidden mt-2 text-gray-700 px-6" style="font-family: NunitoLight;">
                    {{ $faq['answer'] }}
                </div>
            </div>
        @endforeach
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
    height: auto;
    opacity: 1;
    animation: fadeIn 0.5s ease-out;
}

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
</style>

<script>
function toggleAnswer(button) {
    const answer = button.nextElementSibling;
    const isHidden = answer.classList.contains('hidden');
    
    answer.classList.toggle('hidden');
    answer.classList.toggle('show');
    button.querySelector('span').textContent = isHidden ? '−' : '+';
}
</script>
@endsection
