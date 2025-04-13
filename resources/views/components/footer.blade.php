<footer class="bg-black text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <!-- Top Section with Logo and Newsletter -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 pb-8 border-b border-gray-800">
            <!-- Logo and About -->
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60" width="200" height="60">
                  <!-- Skateboard Shape -->
                  <g transform="translate(0, 5)">
                      <!-- Deck with white outline -->
                      <path d="M30,25 C30,15 170,15 170,25 C170,35 30,35 30,25 Z" 
                            fill="#fbbf24" 
                            stroke="#fff" 
                            stroke-width="4"/>
                      
                      <!-- Wheels with white outline -->
                      <circle cx="50" cy="40" r="8" fill="#000" stroke="#fff" stroke-width="2"/>
                      <circle cx="50" cy="40" r="3" fill="#333"/>
                      <circle cx="150" cy="40" r="8" fill="#000" stroke="#fff" stroke-width="2"/>
                      <circle cx="150" cy="40" r="3" fill="#333"/>
                      
                      <!-- White text with black outline (stroke) -->
                      <text x="100" y="28" font-family="BebasNeue, sans-serif" font-size="20" text-anchor="middle"
                            fill="#fff" stroke="#000" stroke-width="0.5" font-weight="bold">
                          SKATE SHOP
                      </text>
                  </g>
              </svg>
                </a>
                <p class="text-gray-400 mb-4" style="font-family: NunitoLight;">
                    Váš prémiový obchod se skateboardy a příslušenstvím. Kvalita, styl a vášeň pro skateboarding od roku 2010.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <x-heroicon-o-globe-alt class="h-6 w-6" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4" style="font-family: BebasNeue;">NAVIGACE</h3>
                    <ul class="space-y-2" style="font-family: NunitoLight;">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-yellow-400 transition-colors">Domů</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-yellow-400 transition-colors">Produkty</a></li>
                        <li><a href="{{ route('questions.index') }}" class="text-gray-400 hover:text-yellow-400 transition-colors">Časté dotazy</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-yellow-400 transition-colors">Kontakt</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" style="font-family: BebasNeue;">INFORMACE</h3>
                    <ul class="space-y-2" style="font-family: NunitoLight;">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">O nás</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">Doprava a platba</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">Obchodní podmínky</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">Ochrana soukromí</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-bold mb-4" style="font-family: BebasNeue;">ODBĚR NOVINEK</h3>
                <p class="text-gray-400 mb-4" style="font-family: NunitoLight;">
                    Přihlaste se k odběru novinek a získejte slevu 10% na první nákup.
                </p>
                <form action="#" method="POST" class="flex">
                    <input type="email" name="email" placeholder="Váš e-mail" required
                           class="flex-1 py-2 px-4 bg-gray-800 text-white border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                           style="font-family: NunitoLight;">
                    <button type="submit" class="bg-yellow-400 text-black px-4 py-2 rounded-r-lg hover:bg-yellow-500 transition-colors font-bold" style="font-family: Nunito;">
                        Odebírat
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Bottom Section with Copyright and Payment Methods -->
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <p class="text-gray-400" style="font-family: NunitoLight;">
                    &copy; {{ date('Y') }} SKATESHOP. Všechna práva vyhrazena. Vytvořil Lukáš Juřena.
                </p>
            </div>
            
        </div>
    </div>
</footer>
