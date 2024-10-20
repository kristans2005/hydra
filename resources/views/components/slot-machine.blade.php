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
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  overflow: hidden;
}

*,
*::before,
*::after {
  -webkit-box-sizing: inherit;
  -moz-box-sizing: inherit;
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
  text-transform: uppercase;

  margin: 0 0.2rem 0 0.2rem;
}

.info {
  position: fixed;
  bottom: 0;
  width: 100%;
  text-align: center;
}

    </style>
</head>
<body>
    <div id="app">
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
</div>

  {{-- <p class="info"></p> --}}
</div>

<script>
    (function () {
  "use strict";

  const items = [
    "🍭",
    "❌",
    "⛄️",
    "🦄",
    "🍌",
    "💩",
    "👻",
    "😻",
    "💵",
    
  ];
  // document.querySelector(".info").textContent = items.join(" ");

  const doors = document.querySelectorAll(".door");
  document.querySelector("#spinner").addEventListener("click", spin);
  document.querySelector("#reseter").addEventListener("click", () => init(true));

  async function spin() {
    // Do not reset spin state, but just spin again
    init(false, 1, 2);
    for (const door of doors) {
      const boxes = door.querySelector(".boxes");
      const duration = parseInt(boxes.style.transitionDuration);
      boxes.style.transform = "translateY(0)";
      await new Promise((resolve) => setTimeout(resolve, duration * 100));
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
          arr.push(...items);
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

  init();
})();
</script>
</body>
</html>
