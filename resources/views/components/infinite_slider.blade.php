<!-- resources/views/components/infinite_slider.blade.php -->
<div class="relative py-8">
    <!-- Levá šipka -->
    <button id="leftArrow" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black hover:bg-gray-800 text-white rounded-full w-12 h-12 flex items-center justify-center z-10 transition-all duration-300 ease-in-out"
        onclick="scrollSlider(event, 'left')">
        &#9664; <!-- Levá šipka bude bílá -->
    </button>

    <!-- Slider -->
    <div id="slider" class="flex overflow-x-auto space-x-4 pb-6 scroll-smooth">
        @foreach($products as $product)
        <div class="product-item min-w-[200px] bg-white shadow-md rounded-lg p-4">
            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
            <p class="text-lg text-gray-600">{{ $product->price }} Kč</p>
            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:text-blue-600">View Product</a>
        </div>
        @endforeach
    </div>

    <!-- Pravá šipka -->
    <button id="rightArrow" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black hover:bg-gray-800 text-white rounded-full w-12 h-12 flex items-center justify-center z-10 transition-all duration-300 ease-in-out"
        onclick="scrollSlider(event, 'right')">
        &#9654; <!-- Pravá šipka bude bílá -->
    </button>
</div>

<script>
    // Funkce definována před použitím
    function scrollSlider(event, direction) {
        event.preventDefault(); // Zrušíme výchozí akci tlačítka (pokud by bylo potřeba)

        const slider = document.getElementById('slider');
        const scrollAmount = 300; // Kolik pixelů se posune na kliknutí

        if (!slider) {
            console.error('Slider not found!');
            return;
        }

        // Animace plynulého posunu pomocí scrollTo() s smooth chováním
        if (direction === 'left') {
            console.log("Kliknuto na levé tlačítko! Posouvám o " + scrollAmount + "px doleva.");
            slider.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            }); // Posun do leva s plynulým chováním
        } else if (direction === 'right') {
            console.log("Kliknuto na pravé tlačítko! Posouvám o " + scrollAmount + "px doprava.");
            slider.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            }); // Posun doprava s plynulým chováním
        }
    }
</script>

<style>
    /* Nastavení pro slider */
    #slider {
        display: flex;
        overflow-x: auto;
        padding-bottom: 6px;
        scroll-behavior: smooth; /* Plynulý posun pro všechny akce scrollování */
    }

    /* Vzhled jednotlivých položek */
    .product-item {
        min-width: 200px;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 16px;
        margin-right: 16px; /* mezera mezi položkami */
        flex-shrink: 0; /* Zajištění, že položky se nebudou zmenšovat */
        transition: transform 0.3s ease-in-out; /* Plynulý efekt pro položky při posunu */
    }

    /* Efekt při hoveru na položce */
    .product-item:hover {
        transform: scale(1.05); /* Trochu zvětšíme položku při najetí */
    }

    /* Vzhled obrázku v každé položce */
    #slider img {
        width: 100%;
        height: 180px; /* Fixní výška pro obrázky */
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    /* Vzhled pro šipky */
    #leftArrow, #rightArrow {
        position: absolute;
        top: 45%;
        z-index: 10;
        cursor: pointer;
        background-color: black; /* Nastavení černého pozadí pro tlačítka */
        border: none;
        padding: 8px;
        border-radius: 50%;
        transition: background-color 0.3s, transform 0.3s ease-in-out; /* Plynulý efekt pro šipky */
        color: white; /* Bílý text pro šipky */
        font-size: 20px; /* Větší font pro šipky */
        width: 48px; /* Zvýšení šířky */
        height: 48px; /* Zvýšení výšky */
    }

    #leftArrow {
        left: 16px;
    }

    #rightArrow {
        right: 16px;
    }

    /* Efekt na tlačítka při hoveru */
    #leftArrow:hover, #rightArrow:hover {
        background-color: rgba(0, 0, 0, 0.7); /* Při hoveru tmavší černá */
        transform: scale(1.2); /* Zvětšení tlačítka při hoveru */
    }

    /* Různé přizpůsobení pro mobilní zařízení */
    @media (max-width: 768px) {
        .product-item {
            min-width: 150px; /* Na menších obrazovkách menší šířka položek */
        }

        #leftArrow, #rightArrow {
            width: 40px;
            height: 40px;
        }
    }

    /* Opravy pro první a poslední produkt */
    #slider .product-item:first-child {
        margin-left: 0; /* Odstranit margin na levé straně pro první položku */
        margin: 0 !important;
    }

    #slider .product-item:last-child {
        margin-right: 0; /* Odstranit margin na pravé straně pro poslední položku */
        
    }
</style>