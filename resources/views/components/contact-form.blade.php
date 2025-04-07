<div class="py-32 bg-gray-900 text-black text-center h-auto" style="font-family: NunitoLight;">
    <h1 class="text-5xl font-extrabold mb-24" style="margin-bottom: 100px !important; font-family: BebasNeue;">Kontaktujte nás</h1>

    <div class="max-w-4xl mx-auto grid grid-cols-2 gap-[50px] items-center" >
        <!-- Levá část - formulář -->
        <div class="space-y-6 text-left">
            <p class="text-gray-400 text-lg">
                Máte otázku? Zanechte nám zprávu a my se vám co nejdříve ozveme.
            </p>

            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-4">
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

                <button type="submit" class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md">
                    Odeslat zprávu
                </button>
            </form>
        </div>

        <!-- Pravá část - obrázek -->
        <div class="flex justify-center items-center">
            <img src="{{ asset('photos/picture1.jpg') }}" class="w-40 h-40 object-cover rounded-lg shadow-lg">
        </div>
        
    </div>
</div>
