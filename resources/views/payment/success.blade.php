@extends('layouts.app')

@section('content')
    <div class="h-20"></div>
    <div class="container py-10 mx-auto max-w-6xl">
        <h1 class="text-4xl font-semibold text-center text-black mb-8">Platba byla úspěšná!</h1>

        <div class="text-center">
            <p class="text-xl text-green-600">Děkujeme za vaši objednávku. Vaše platba byla úspěšně zpracována.</p>
            <a href="{{ route('home') }}" class="inline-block px-8 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out mt-6">
                Pokračovat na domovskou stránku
            </a>
        </div>
    </div>
@endsection