@extends('layouts.app')

@section('content')
<div class="h-20">
</div>
    <div class="container py-10 mx-auto max-w-6xl">
        <h1 class="text-4xl font-semibold text-center text-black mb-8">Nákupní Košík</h1>

        <!-- Back to Products Button -->
        <div class="text-center mb-4 mt-8">
            <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 text-black bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                Zpět na produkty
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
                            <th class="px-6 py-3 text-left">Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 text-black">
                                <td class="px-6 py-4 text-sm font-medium">{{ $item['name'] }}</td>
                                <td class="px-6 py-4 text-sm">${{ $item['price'] }}</td>
                                <td class="px-6 py-4 text-sm">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 text-sm">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200 ease-in-out">
                                            <i class="fas fa-trash-alt"></i> Odstranit
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Checkout Button -->
            <div class="mt-8 flex justify-end">
                <a href="{{ route('checkout.index') }}" class="inline-block px-8 py-4 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    Přejít k pokladně
                </a>
            </div>
        @else
            <p class="text-center text-black text-xl mt-6">Váš košík je prázdný. Prohlédněte si naše produkty a přidejte něco do košíku!</p>
        @endif
    </div>
@endsection