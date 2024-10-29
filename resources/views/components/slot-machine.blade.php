<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html,
        body {
            width: 100vw;
            height: 100vh;
            margin: 0;
            border: 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        *,
        *::before,
        *::after {
            box-sizing: inherit;
        }

        #app {
            width: 100%;
            height: 100%;
            background: #212121;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .doors {
            display: flex;
        }

        .door {
            background: #fafafa;
            box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.4) inset;
            width: 100px;
            height: 150px;
            overflow: hidden;
            border-radius: 1ex;
            margin: 1ch;
        }

        .boxes {
            transition: transform 1s ease-in-out;
        }

        .box {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
        }

        .buttons {
            margin: 1rem 0 2rem 0;
        }

        button {
            cursor: pointer;
            font-size: 1.2rem;
            margin: 0 0.2rem 0 0.2rem;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 5px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

       

        button:active {
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        #spinner {
            background: linear-gradient(135deg, #4caf50, #388e3c);
        }

        #spinner:hover {
            background: linear-gradient(135deg, #388e3c, #4caf50);
        }

        #reseter {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        #reseter:hover {
            background: linear-gradient(135deg, #d32f2f, #f44336);
        }

        #autospin {
            background: linear-gradient(135deg, #3f51b5, #1a237e);
        }

        #autospin:hover {
            background: linear-gradient(135deg, #1a237e, #3f51b5);
        }

        #bonus-buy {
            background: linear-gradient(135deg, #ffeb3b, #fbc02d);
            color: black;
        }

        #bonus-buy:hover {
            background: linear-gradient(135deg, #fbc02d, #ffeb3b);
        }

        #free-spin {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
        }

        #free-spin:hover {
            background: linear-gradient(135deg, #7b1fa2, #9c27b0);
        }

        .info {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .score {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .confetti {
            position: absolute;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="score">Score: <span id="score">0</span></div>
        <div class="doors">
            <div class="door">
                <div class="boxes">
                    <!-- <div class="box">?</div> -->
                </div>
            </div>
            <div class="door">
                <div class="boxes">
                    <!-- <div class="box">?</div> -->
                </div>
            </div>
            <div class="door">
                <div class="boxes">
                    <!-- <div class="box">?</div> -->
                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="spinner" class="text-white">Spin</button>
            <button id="reseter" class="text-white">Reset</button>
            <button id="autospin" class="text-white">Autospin</button>
            <button id="bonus-buy" class="text-white">Bonus Buy (-500)</button>
            <button id="free-spin" class="text-white">Free Spin (10)</button>
        </div>
        <audio id="spin-sound" src="{{ asset('audio/spin.wav') }}" preload="auto"></audio>
        <canvas class="confetti" id="confetti"></canvas>
        {{-- <p class="info"></p> --}}
    </div>

    <script>
        (function () {
            "use strict";

            const items = [
                "🍭", "❌", "⛄️", "🦄", "🍌", "💩", "👻", "😻", "💵"
            ];

            const doors = document.querySelectorAll(".door");
            const scoreElement = document.getElementById("score");
            let score = 0;
            let confettiActive = false;
            let confettiAnimation;
            let autospinInterval = null;
            let freeSpinCount = 0;

            document.querySelector("#spinner").addEventListener("click", () => spin());
            document.querySelector("#reseter").addEventListener("click", () => init(true));
            document.querySelector("#autospin").addEventListener("click", toggleAutospin);
            document.querySelector("#bonus-buy").addEventListener("click", bonusBuy);
            document.querySelector("#free-spin").addEventListener("click", freeSpin);

            function updateScore(points) {
                score += points;
                scoreElement.textContent = score;
            }

            function toggleAutospin() {
                const button = document.getElementById("autospin");
                if (autospinInterval) {
                    clearInterval(autospinInterval);
                    autospinInterval = null;
                    button.textContent = "Autospin";
                } else {
                    autospinInterval = setInterval(spin, 3000);
                    button.textContent = "Stop Autospin";
                }
            }

            function bonusBuy() {
                if (score >= 500) {
                    updateScore(-500); // Deduct points for the bonus
                    freeSpinCount = 10; // Reset free spins to 10
                    alert("You bought a bonus and received 10 free spins!");
                    spin(); // Spin immediately after buying the bonus
                } else {
                    alert("Not enough points to buy a bonus!");
                }
            }

            function freeSpin() {
                if (freeSpinCount > 0) {
                    freeSpinCount--;
                    spin(true);
                } else {
                    alert("You have no free spins left!");
                }
            }

            async function spin(isFreeSpin = false) {
                const spinSound = document.getElementById('spin-sound');
                spinSound.currentTime = 0;
                spinSound.play();

                stopConfetti();

                init(false, 1, 2);

                let jackpot = true;

                for (const door of doors) {
                    const boxes = door.querySelector(".boxes");
                    const duration = parseInt(boxes.style.transitionDuration);
                    boxes.style.transform = "translateY(0)";
                    await new Promise((resolve) => setTimeout(resolve, duration * 100));

                    const result = boxes.querySelector('.box').textContent;
                    if (result !== "🦄") {
                        jackpot = false;
                    }
                }

                if (jackpot) {
                    updateScore(2000);
                    startConfetti();
                } else if (!isFreeSpin) {
                    updateScore(-100);
                }
            }

            function init(firstInit = true, groups = 1, duration = 1) {
                for (const door of doors) {
                    const boxes = door.querySelector(".boxes");
                    const boxesClone = boxes.cloneNode(false);
                    const pool = ["❓"];
                    if (!firstInit) {
                        const arr = [];
                        for (let n = 0; n < (groups > 0 ? groups : 1); n++) {
                            arr.push(...items.concat("🦄", "🦄", "🦄"));
                        }
                        pool.push(...shuffle(arr));

                        boxesClone.addEventListener(
                            "transitionstart",
                            function () {
                                this.querySelectorAll(".box").forEach((box) => {
                                    box.style.filter = "blur(1px)";
                                });
                            },
                            { once: true }
                        );

                        boxesClone.addEventListener(
                            "transitionend",
                            function () {
                                this.querySelectorAll(".box").forEach((box, index) => {
                                    box.style.filter = "blur(0)";
                                    if (index > 0) this.removeChild(box);
                                });
                            },
                            { once: true }
                        );
                    }

                    for (let i = pool.length - 1; i >= 0; i--) {
                        const box = document.createElement("div");
                        box.classList.add("box");
                        box.style.width = door.clientWidth + "px";
                        box.style.height = door.clientHeight + "px";
                        box.textContent = pool[i];
                        boxesClone.appendChild(box);
                    }
                    boxesClone.style.transitionDuration = `${duration > 0 ? duration : 1}s`;
                    boxesClone.style.transform = `translateY(-${
                        door.clientHeight * (pool.length - 1)
                    }px)`;
                    door.replaceChild(boxesClone, boxes);
                }
            }

            function shuffle([...arr]) {
                let m = arr.length;
                while (m) {
                    const i = Math.floor(Math.random() * m--);
                    [arr[m], arr[i]] = [arr[i], arr[m]];
                }
                return arr;
            }

            function startConfetti() {
                const confetti = document.getElementById("confetti");
                const ctx = confetti.getContext("2d");
                confetti.width = window.innerWidth;
                confetti.height = window.innerHeight;

                const particles = [];
                const numParticles = 150;
                for (let i = 0; i < numParticles; i++) {
                    particles.push({
                        x: Math.random() * confetti.width,
                        y: Math.random() * confetti.height,
                        speedX: Math.random() * 5 - 2.5,
                        speedY: Math.random() * 3 + 1,
                        size: Math.random() * 5 + 2,
                        color: `hsl(${Math.random() * 360}, 100%, 50%)`
                    });
                }

                confettiActive = true;

                function animateConfetti() {
                    ctx.clearRect(0, 0, confetti.width, confetti.height);

                    particles.forEach(p => {
                        ctx.fillStyle = p.color;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.size, 0, 2 * Math.PI);
                        ctx.fill();
                        p.x += p.speedX;
                        p.y += p.speedY;

                        if (p.y > confetti.height) p.y = -p.size;
                        if (p.x > confetti.width) p.x = -p.size;
                    });

                    confettiAnimation = requestAnimationFrame(animateConfetti);
                }

                animateConfetti();
            }

            function stopConfetti() {
                const confetti = document.getElementById("confetti");
                const ctx = confetti.getContext("2d");
                if (confettiActive) {
                    ctx.clearRect(0, 0, confetti.width, confetti.height);
                    cancelAnimationFrame(confettiAnimation);
                    confettiActive = false;
                }
            }

            init();
        })();
    </script>
</body>
</html>
