<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Slot Machine</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="flex flex-col items-center">
        <div class="flex space-x-4 mb-5">
            <div class="slot w-24 h-36 border border-black rounded-lg bg-white shadow-inner overflow-hidden">
                <div class="symbols" id="slot1Symbols"></div>
            </div>
            <div class="slot w-24 h-36 border border-black rounded-lg bg-white shadow-inner overflow-hidden">
                <div class="symbols" id="slot2Symbols"></div>
            </div>
            <div class="slot w-24 h-36 border border-black rounded-lg bg-white shadow-inner overflow-hidden">
                <div class="symbols" id="slot3Symbols"></div>
            </div>
        </div>

        <div class="flex space-x-2">
            <button onclick="spin()" class="px-4 py-2 bg-blue-500 text-white rounded">Spin</button>
            <button onclick="reset()" class="px-4 py-2 bg-red-500 text-white rounded">Reset</button>
        </div>
    </div>

    <script>const slotSymbols = [
        ['😀', '😁', '😂', '😃', '😄', '😅', '😆', '😇', '😈', '😉', '😊', '🙂'],
        ['🍎', '🍏', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🍈', '🍒', '🍑'],
        ['⭐️', '🌟', '✨', '💫', '⚡️', '☄️', '🌠', '🌌', '🌙', '🌕', '🌖', '🌗']
    ];
    
    function createSymbolElement(symbol) {
        const div = document.createElement('div');
        div.classList.add('symbol');
        div.textContent = symbol;
        return div;
    }
    
    let spun = false;
    function spin() {
        if (spun) {
            reset();
        }
        const slots = document.querySelectorAll('.slot');
        let completedSlots = 0;
    
        slots.forEach((slot, index) => {
            const symbols = slot.querySelector('.symbols');
            const symbolHeight = symbols.querySelector('.symbol')?.clientHeight;
            const symbolCount = symbols.childElementCount;
    
            symbols.innerHTML = '';
            symbols.appendChild(createSymbolElement('❓'));
    
            for (let i = 0; i < 3; i++) {
                slotSymbols[index].forEach(symbol => {
                    symbols.appendChild(createSymbolElement(symbol));
                });
            }
    
            const totalDistance = symbolCount * symbolHeight;
            const randomOffset = -Math.floor(Math.random() * (symbolCount - 1) + 1) * symbolHeight;
            symbols.style.top = `${randomOffset}px`;
    
            symbols.addEventListener('transitionend', () => {
                completedSlots++;
                if (completedSlots === slots.length) {
                    logDisplayedSymbols();
                }
            }, { once: true });
        });
    
        spun = true;
    }
    
    function reset() {
        const slots = document.querySelectorAll('.slot');
    
        slots.forEach(slot => {
            const symbols = slot.querySelector('.symbols');
            symbols.style.transition = 'none';
            symbols.style.top = '0';
            symbols.offsetHeight; // Trigger a reflow
            symbols.style.transition = '';
        });
    }
    
    function logDisplayedSymbols() {
        const slots = document.querySelectorAll('.slot');
        const displayedSymbols = [];
    
        slots.forEach((slot, index) => {
            const symbols = slot.querySelector('.symbols');
            const symbolIndex = Math.floor(Math.abs(parseInt(symbols.style.top, 10)) / slot.clientHeight) % slotSymbols[index].length;
            const displayedSymbol = slotSymbols[index][symbolIndex];
            displayedSymbols.push(displayedSymbol);
        });
    
        console.log(displayedSymbols);
    }
    </script> <!-- Include the JavaScript file -->
</body>
</html>
