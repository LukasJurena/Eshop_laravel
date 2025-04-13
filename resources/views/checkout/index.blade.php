@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-20">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-4xl font-bold text-center mb-8" style="font-family: BebasNeue;">POKLADNA</h1>

        <!-- Back to Cart Button -->
        <div class="text-center mb-8">
            <a href="{{ route('cart.index') }}" class="inline-flex items-center px-6 py-3 text-black bg-yellow-400 rounded-lg shadow-md hover:bg-yellow-500 transition duration-300" style="font-family: Nunito;">
                <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                Zpět do košíku
            </a>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-6">
                        <div class="bg-black text-white px-6 py-4">
                            <h2 class="text-xl font-bold" style="font-family: Nunito;">Shrnutí objednávky</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-gray-700" style="font-family: Nunito;">Produkt</th>
                                        <th class="px-6 py-3 text-left text-gray-700" style="font-family: Nunito;">Cena</th>
                                        <th class="px-6 py-3 text-left text-gray-700" style="font-family: Nunito;">Množství</th>
                                        <th class="px-6 py-3 text-left text-gray-700" style="font-family: Nunito;">Celková cena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $id => $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    @if(isset($item['image']))
                                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-md mr-3">
                                                    @else
                                                        <div class="w-12 h-12 bg-gray-200 rounded-md mr-3 flex items-center justify-center">
                                                            <x-heroicon-o-photo class="h-6 w-6 text-gray-400" />
                                                        </div>
                                                    @endif
                                                    <span class="font-medium" style="font-family: Nunito;">{{ $item['name'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4" style="font-family: NunitoLight;">{{ $item['price'] }} Kč</td>
                                            <td class="px-6 py-4" style="font-family: NunitoLight;">{{ $item['quantity'] }}</td>
                                            <td class="px-6 py-4 font-medium" style="font-family: Nunito;">{{ number_format($item['price'] * $item['quantity'], 2) }} Kč</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 flex justify-end">
                            <div class="text-right">
                                <div class="text-gray-600 mb-1" style="font-family: NunitoLight;">Mezisoučet:</div>
                                <div class="text-xl font-bold" style="font-family: Nunito;">{{ number_format(array_sum(array_map(function ($item) {
                                    return $item['price'] * $item['quantity'];
                                }, session('cart'))), 2) }} Kč</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="lg:col-span-1">
                    <form action="{{ route('checkout.process') }}" method="POST" class="bg-white shadow-lg rounded-xl p-6">
                        @csrf
                        <h3 class="text-xl font-bold mb-6 pb-3 border-b border-gray-200" style="font-family: Nunito;">Fakturační údaje</h3>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Jméno</label>
                            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-transparent" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Email</label>
                            <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-transparent" required>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Adresa</label>
                            <input type="text" name="address" id="address" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-transparent" required>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="mb-6">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1" style="font-family: Nunito;">Metoda platby</label>
                            <div class="relative">
                                <select name="payment_method" id="payment_method" class="w-full p-3 border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent" required>
                                    <option value="paypal">PayPal</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="visa">Visa</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                    <x-heroicon-s-chevron-down class="h-4 w-4" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="w-full px-6 py-4 bg-black text-white rounded-lg shadow-md hover:bg-gray-800 transition duration-300 flex items-center justify-center" style="font-family: Nunito;">
                                <x-heroicon-o-check-circle class="h-5 w-5 mr-2" />
                                Dokončit objednávku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-white p-12 rounded-xl shadow-lg text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <x-heroicon-o-shopping-cart class="h-10 w-10 text-yellow-500" />
                </div>
                <h2 class="text-2xl font-bold mb-4" style="font-family: Nunito;">Váš košík je prázdný</h2>
                <p class="text-gray-600 mb-8" style="font-family: NunitoLight;">Prohlédněte si naše produkty a přidejte něco do košíku!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 bg-yellow-400 text-black rounded-lg shadow-md hover:bg-yellow-500 transition duration-300" style="font-family: Nunito;">
                    <x-heroicon-o-shopping-bag class="h-5 w-5 mr-2" />
                    Prozkoumat produkty
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
