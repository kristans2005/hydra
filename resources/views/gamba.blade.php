<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Avaliable slots
        </h2>
    </x-slot>


    
<body class="flex items-center justify-center h-screen w-screen bg-[#c7e6e6]">
    <div class="relative w-[400px] h-[400px] min-w-[400px] min-h-[400px] overflow-hidden shadow-[0px_0px_160px_rgba(17,17,17,0.25)]">
        <div class="absolute border-t-[200px] border-r-[200px] border-b-[200px] border-l-[200px] border-transparent z-[200]"></div>
        <button class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[140px] w-[140px] bg-[#7FC2C2] text-[#f5f5f5] font-bold text-4xl rounded-none hover:h-[150px] hover:w-[150px] hover:bg-[#8CD0D0] transition-all active:h-[135px] active:w-[135px] active:bg-[#459A9A] active:text-[#7FC2C2] z-[300]">
            GO!
        </button>
        <input type="number" min="0" max="100000" value="10" class="absolute bottom-[40px] left-1/2 transform -translate-x-1/2 text-[#7FC2C2] bg-[#f5f5f5] rounded-[36px] text-center p-2 text-4xl font-bold z-[300] focus:text-[#459A9A] hover:text-[#8CD0D0] transition-all">
        <div class="absolute w-[400px] h-[400px] spinner__plate">
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-[200px] h-[calc(200px-40px)] pt-[40px] text-[#459A9A] text-center font-bold text-3xl" style="transform-origin: 50% 100%;">1</div>
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-[200px] h-[calc(200px-40px)] pt-[40px] text-[#459A9A] text-center font-bold text-3xl rotate-90" style="transform-origin: 50% 100%;">2</div>
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-[200px] h-[calc(200px-40px)] pt-[40px] text-[#459A9A] text-center font-bold text-3xl rotate-180" style="transform-origin: 50% 100%;">3</div>
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-[200px] h-[calc(200px-40px)] pt-[40px] text-[#459A9A] text-center font-bold text-3xl rotate-270" style="transform-origin: 50% 100%;">4</div>
        </div>
    </div>

    <script>
        const spinner = document.querySelector('.spinner');
        const startBtn = document.querySelector('button');
        const input = document.querySelector('input[type="number"]');
        let plate = document.querySelector('.spinner__plate');
        let items = [...document.getElementsByClassName('spinner__item')];

        input.addEventListener('change', (e) => {
            if (input.value === '' || +input.value < 1) {
                input.value = 1;
            }
            if (+input.value > input.max) {
                input.value = input.max;
            }
        });

        startBtn.addEventListener('click', function() {
            randomizeItems();
            if (!plate.classList.contains('spinner__plate--spin')) {
                plate.classList.add('spinner__plate--spin');
            } else {
                const currPlate = plate;
                const newPlate = plate.cloneNode(true);
                currPlate.parentNode.replaceChild(newPlate, currPlate);
                plate = newPlate;
                items = [...document.getElementsByClassName('spinner__item')];
            }
        });

        function randomizeItems() {
            items.forEach((item) => {
                const rand = random(1, +input.value);
                item.textContent = rand;
            });
        }

        function random(min, max) {
            let rand = min - 0.5 + Math.random() * (max - min + 1);
            return Math.round(rand);
        }
    </script>
</body>


</x-app-layout>
