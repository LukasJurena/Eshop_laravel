@extends('layouts.app')

@section('content')
<div class="h-20">
</div>
    <div class="container py-10 mx-auto max-w-6xl">
        <h1 class="text-4xl font-semibold text-center text-black mb-8">Pokladna</h1>

        <!-- Back to Cart Button -->
        <div class="text-center mb-4 mt-8">
            <a href="{{ route('cart.index') }}" class="inline-block px-8 py-3 text-black bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                Zpět do košíku
            </a>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full table-auto text-gray-800">
                    <thead class="bg-blue-600 text-black">
                        <tr>
                            <th class="px-6 py-3 text-left">Produkt</th>
                            <th class="px-6 py-3 text-left">Cena</th>
                            <th class="px-6 py-3 text-left">Množství</th>
                            <th class="px-6 py-3 text-left">Celková cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 text-black">
                                <td class="px-6 py-4 text-sm font-medium">{{ $item['name'] }}</td>
                                <td class="px-6 py-4 text-sm">${{ $item['price'] }}</td>
                                <td class="px-6 py-4 text-sm">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 text-sm">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Price -->
            <div class="mt-8 flex justify-end text-xl font-semibold">
                <p class="text-black">Celková cena: ${{ number_format(array_sum(array_map(function ($item) {
                    return $item['price'] * $item['quantity'];
                }, session('cart'))), 2) }}</p>
            </div>

            <!-- Checkout Form -->
            <div class="mt-8">
                <form action="{{ route('checkout.process') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
                    @csrf
                    <h3 class="text-2xl font-semibold text-center text-black mb-6">Zadejte své údaje pro dokončení objednávky</h3>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Jméno</label>
                        <input type="text" name="name" id="name" class="w-full mt-2 p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full mt-2 p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Adresa</label>
                        <input type="text" name="address" id="address" class="w-full mt-2 p-3 border border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="inline-block px-8 py-4 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                            Dokončit objednávku
                        </button>
                    </div>
                </form>
            </div>
        @else
            <p class="text-center text-black text-xl mt-6">Váš košík je prázdný. Prohlédněte si naše produkty a přidejte něco do košíku!</p>
        @endif
    </div>
@endsection
