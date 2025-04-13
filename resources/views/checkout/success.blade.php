@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-20">
    <div class="container mx-auto px-4 py-16 max-w-3xl">
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <x-heroicon-o-check-circle class="h-10 w-10 text-green-500" />
            </div>
            
            <h1 class="text-4xl font-bold mb-4" style="font-family: BebasNeue;">ÚSPĚŠNÁ PLATBA!</h1>
            
            <div class="w-16 h-1 bg-yellow-400 mx-auto mb-6"></div>
            
            <p class="text-xl mb-8" style="font-family: NunitoLight;">Vaše platba byla úspěšně zpracována. Děkujeme za nákup!</p>
            
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold mb-3" style="font-family: Nunito;">Co bude dál?</h3>
                <p class="text-gray-600 mb-4" style="font-family: NunitoLight;">Obdržíte potvrzení objednávky na váš e-mail. Vaše objednávka bude zpracována a odeslána co nejdříve.</p>
                <div class="flex items-center justify-center text-sm text-gray-500">
                    <x-heroicon-o-clock class="h-4 w-4 mr-1" />
                    <span style="font-family: NunitoLight;">Očekávaná doba doručení: 1-3 pracovní dny</span>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-yellow-400 text-black rounded-lg shadow-md hover:bg-yellow-500 transition duration-300" style="font-family: Nunito;">
                    <x-heroicon-o-shopping-bag class="h-5 w-5 mr-2" />
                    Pokračovat v nákupu
                </a>
                
                <a href="#" class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-800 rounded-lg shadow-md hover:bg-gray-300 transition duration-300" style="font-family: Nunito;">
                    <x-heroicon-o-document-text class="h-5 w-5 mr-2" />
                    Zobrazit objednávku
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
