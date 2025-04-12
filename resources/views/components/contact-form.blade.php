<div class="bg-gray-50 min-h-screen">
    <!-- Hero Banner -->
    <div class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center mb-4 mt-20" style="font-family: BebasNeue;">KONTAKTUJTE NÁS</h1>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>
    </div>

    <div class="max-w-4xl mt-6 mx-auto grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-[50px] items-center">
        <!-- Levá část - formulář -->
        <div class="space-y-6 text-left p-4">
            <p class="text-gray-400 text-lg">
                Máte otázku? Zanechte nám zprávu a my se vám co nejdříve ozveme.
            </p>

            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <input type="text" id="first_name" name="first_name" placeholder="Jméno" 
                            class="w-full border border-gray-600 focus:border-blue-400 outline-none bg-gray-800 bg-opacity-50 p-3 text-lg rounded-md">
                    </div>
                    <div class="relative">
                        <input type="text" id="last_name" name="last_name" placeholder="Příjmení" 
                            class="w-full border border-gray-600 focus:border-blue-400 outline-none bg-gray-800 bg-opacity-50 p-3 text-lg rounded-md">
                    </div>
                </div>

                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="E-mail" 
                        class="w-full border border-gray-600 focus:border-blue-400 outline-none bg-gray-800 bg-opacity-50 p-3 text-lg rounded-md">
                </div>

                <div class="relative">
                    <textarea id="message" name="message" placeholder="Vaše zpráva"
                        class="w-full border border-gray-600 focus:border-blue-400 outline-none bg-gray-800 bg-opacity-50 p-3 text-lg h-24 rounded-md"></textarea>
                </div>

                <button type="submit" class="mt-6 bg-yellow-400 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-md">
                    Odeslat zprávu
                </button>
            </form>
        </div>

        <!-- Pravá část - obrázek -->
        <div class="flex justify-center items-center">
            <img src="{{ asset('images/contact.jpg') }}" class="w-auto h-auto object-cover rounded-lg ">
        </div>
    </div>
</div>