
    <style>
        /* Základní styl pro tlačítko */
        .floating-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 50; /* Zajistí, že tlačítko bude nahoře nad ostatními elementy */
        }

        .floating-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            background-color: white; /* Tmavě modrá */
            color: black;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            text-align: center;
        }

        .floating-button:hover {
            background-color:rgb(250 204 21 / var(--tw-bg-opacity, 1)); /* Světlejší modrá při hoveru */
        }

        /* Tooltip stylování */
        .tooltip {
            position: absolute;
            bottom: 70px; /* Aby byl nad tlačítkem */
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 12px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        

        .floating-button-container:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>


    <!-- Floating Button Container -->
    <div class="floating-button-container">
        <!-- Tooltip (skrytý až po najetí myší) -->
        <div class="tooltip">
            Máte otázky?
        </div>
        <!-- Button -->
        <a href="/questions" class="floating-button">
            <span>?</span> <!-- Otazník jako text -->
        </a>
    </div>


