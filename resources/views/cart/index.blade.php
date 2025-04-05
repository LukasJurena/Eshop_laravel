@extends('layouts.app')

@section('content')
<div class="h-20"></div>
<div class="container py-10 mx-auto max-w-6xl">
    <h1 class="text-4xl font-semibold text-center text-black mb-8">Nákupní Košík</h1>

    <div class="text-center mb-4 mt-8">
        <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
            Zpět na produkty
        </a>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        @php
            $totalPrice = 0;
        @endphp

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-gray-800">
                <thead class="bg-blue-600 text-white">
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
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalPrice += $itemTotal;
                        @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-100 text-black">
                            <td class="px-6 py-4 text-sm font-medium">{{ $item['name'] }}</td>
                            <td class="px-6 py-4 text-sm">${{ $item['price'] }}</td>
                            <td class="px-6 py-4 text-sm">
                                <input type="number" name="quantity" class="quantity-input w-16 border p-2 text-center" 
                                       data-id="{{ $id }}" value="{{ $item['quantity'] }}" min="1">
                            </td>
                            <td class="px-6 py-4 text-sm" id="total-price-{{ $id }}">${{ number_format($itemTotal, 2) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200">
                                        <i class="fas fa-trash-alt"></i> Odstranit
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-right text-lg font-semibold text-black">
            Celková cena: <span id="cart-total" class="text-green-600">${{ number_format($totalPrice, 2) }}</span>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('checkout.index') }}" class="inline-block px-8 py-4 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                Přejít k pokladně
            </a>
        </div>
    @else
        <p class="text-center text-black text-xl mt-6">Váš košík je prázdný. Prohlédněte si naše produkty a přidejte něco do košíku!</p>
    @endif
</div>

<script>
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
                    document.getElementById(`total-price-${productId}`).innerText = `$${data.itemTotal.toFixed(2)}`;
                    document.getElementById('cart-total').innerText = `$${data.cartTotal.toFixed(2)}`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection