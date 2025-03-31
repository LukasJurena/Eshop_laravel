
@extends('layouts.app')

@section('content')
    <div class="container py-10 mx-auto max-w-6xl">
        <h1 class="text-4xl font-semibold text-center text-black mb-8">Objednávka byla úspěšně dokončena!</h1>
        <p class="text-center text-xl">Děkujeme za váš nákup! Brzy obdržíte potvrzení na e-mail.</p>
        <div class="text-center mt-8">
            <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 text-white bg-blue-600 rounded-lg">
                Zpět na produkty
            </a>
        </div>
    </div>
@endsection