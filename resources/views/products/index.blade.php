@extends('layouts.app')

@section('content')
<div class="h-20"> </div>
<div class="container py-10 mx-auto mt-8">
    <h1 class="text-3xl font-semibold text-center mb-8 text-white mt-8 !important">Naše Produkty</h1>

    <!-- CSS pro Grid -->
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .product-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-primary {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <!-- Zobrazit skutečný obrázek z úložiště -->
            <img id="main-image" src="{{ asset('storage/' . $product->images[0]) }}"
            alt="{{ $product->name }}" class="product-image">

            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2 text-center">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-4 product-description">{{ $product->description }}</p>
                <p>
                    Hodnocení:
                    <strong>
                    {{ number_format($product->averageRating(), 1) }} ⭐
                    </strong>
                    <span class="text-gray-400">({{ $product->reviews->count() }}x)</span>
                </p>
                <p class="font-bold text-lg text-blue-600 mb-4 text-center">Cena: {{ $product->price }} Kč</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn-primary">Zobrazit detaily</a>
                <button type="button" class="inline-block px-6 py-2 mt-2 text-white bg-green-500 rounded-md hover:bg-green-600 transition" onclick="showConfirmationBox('{{ route('cart.add', ['product' => $product->id]) }}', {{ $product->id }})">Přidat do košíku</button>
            </div>
        </div>
    @endforeach


    </div>
</div>
<script>
    // Funkce pro zobrazení potvrzovacího boxu
    function showConfirmationBox(productUrl, productId) {
        // Zobrazíme potvrzovací box pro daný produkt
        document.getElementById('confirmation-box-' + productId).classList.remove('hidden');
        document.getElementById('confirmation-box-' + productId).style.display = 'flex';

        // Skryjeme zbytek potvrzovacích boxů
        document.querySelectorAll('.confirmation-box').forEach(function(box) {
            if (box.id !== 'confirmation-box-' + productId) {
                box.style.display = 'none';
            }
        });
    }

    // Funkce pro přidání produktu do košíku a přesměrování na košík
    function addProductAndGoToCart(productId) {
        // Poslat AJAX požadavek pro přidání do košíku
        fetch("{{ route('cart.add', '') }}/" + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Přejít na košík
                window.location.href = "{{ route('cart.index') }}";
            }
        });
    }
</script>

<!-- Potvrzovací boxy, které budou skryté a zobrazené pouze při kliknutí -->
@foreach($products as $product)
    <div id="confirmation-box-{{ $product->id }}" class="confirmation-box">
        <div class="confirmation-content">
            <p>Chcete zůstat na stránce nebo přejít do košíku?</p>
            <div class="btn-container">
                <!-- Form to stay on page and add item to cart -->
                <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" id="stay-form-{{ $product->id }}">
                    @csrf
                    <input type="hidden" name="stay" value="true">
                    <button type="submit" class="btn">Zůstat na stránce</button>
                </form>

                <!-- Link to go to cart page -->
                <a href="{{ route('cart.index') }}" class="btn" onclick="addProductAndGoToCart({{ $product->id }})">Přejít do košíku</a>
            </div>
        </div>
    </div>
@endforeach
@endsection
