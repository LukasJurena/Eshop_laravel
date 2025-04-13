@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-20">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-4xl font-bold text-center mb-8" style="font-family: BebasNeue;">NÁKUPNÍ KOŠÍK</h1>

        <div class="text-center mb-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 text-black bg-yellow-400   hover:bg-yellow-500 transition duration-300 ease-in-out" style="font-family: Nunito;">
                <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                Zpět na produkty
            </a>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            @php
                $totalPrice = 0;
            @endphp

            <div class="overflow-hidden bg-white shadow-lg rounded-xl mb-8">
                <table class="min-w-full table-auto">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="px-6 py-4 text-left" style="font-family: Nunito;">Produkt</th>
                            <th class="px-6 py-4 text-left" style="font-family: Nunito;">Cena</th>
                            <th class="px-6 py-4 text-left" style="font-family: Nunito;">Množství</th>
                            <th class="px-6 py-4 text-left" style="font-family: Nunito;">Celková cena</th>
                            <th class="px-6 py-4 text-left" style="font-family: Nunito;">Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $totalPrice += $itemTotal;
                            @endphp
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if(isset($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-md mr-4 flex items-center justify-center">
                                                <x-heroicon-o-photo class="h-8 w-8 text-gray-400" />
                                            </div>
                                        @endif
                                        <span class="font-medium" style="font-family: Nunito;">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4" style="font-family: NunitoLight;">{{ $item['price'] }} Kč</td>
                                <td class="px-6 py-4">
                                    <div class="custom-number-input h-10 w-32">
                                        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent">
                                            <button type="button" data-action="decrement" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-300 h-full w-10 rounded-l cursor-pointer outline-none flex items-center justify-center">
                                                <span class="m-auto text-xl font-thin">−</span>
                                            </button>
                                            <input type="number" name="quantity" class="quantity-input outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black md:text-base cursor-default flex items-center text-gray-700" 
                                                data-id="{{ $id }}" value="{{ $item['quantity'] }}" min="1">
                                            <button type="button" data-action="increment" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-300 h-full w-10 rounded-r cursor-pointer flex items-center justify-center">
                                                <span class="m-auto text-xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium" id="total-price-{{ $id }}" style="font-family: Nunito;">{{ number_format($itemTotal, 2) }} Kč</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200 flex items-center">
                                            <x-heroicon-o-trash class="h-5 w-5 mr-1" />
                                            <span style="font-family: Nunito;">Odstranit</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="w-full md:w-1/2">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-bold mb-3" style="font-family: Nunito;">Shrnutí objednávky</h3>
                            <div class="flex justify-between mb-2">
                                <span style="font-family: NunitoLight;">Mezisoučet:</span>
                                <span style="font-family: Nunito;">{{ number_format($totalPrice, 2) }} Kč</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span style="font-family: NunitoLight;">Doprava:</span>
                                <span style="font-family: Nunito;">Bude vypočteno v pokladně</span>
                            </div>
                            <div class="border-t border-gray-200 my-3 pt-3 flex justify-between font-bold">
                                <span style="font-family: Nunito;">Celková cena:</span>
                                <span id="cart-total" class="text-xl text-black" style="font-family: Nunito;">{{ number_format($totalPrice, 2) }} Kč</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full md:w-1/2 flex flex-col items-end">
                        <a href="{{ route('checkout.index') }}" class="inline-flex items-center px-8 py-4 bg-black text-white rounded-lg shadow-md hover:bg-gray-800 transition duration-300 w-full md:w-auto justify-center" style="font-family: Nunito;">
                            <span>Přejít k pokladně</span>
                            <x-heroicon-o-arrow-right class="h-5 w-5 ml-2" />
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="inline-flex items-center mt-4 text-black hover:text-yellow-600 transition-colors" style="font-family: NunitoLight;">
                            <x-heroicon-o-shopping-bag class="h-5 w-5 mr-1" />
                            Pokračovat v nákupu
                        </a>
                    </div>
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

<script>
    // Quantity input functionality
    document.querySelectorAll('[data-action="increment"]').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            input.dispatchEvent(new Event('change'));
        });
    });

    document.querySelectorAll('[data-action="decrement"]').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    // Update cart when quantity changes
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            let productId = this.dataset.id;
            let newQuantity = this.value;

            fetch(`/cart/update/${productId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`total-price-${productId}`).innerText = `${data.itemTotal.toFixed(2)} Kč`;
                    document.getElementById('cart-total').innerText = `${data.cartTotal.toFixed(2)} Kč`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

<style>
    /* Custom styles for number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection
