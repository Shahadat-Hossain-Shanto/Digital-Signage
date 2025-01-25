<div class="clock">
    <div class="time-unit hours">
        <div class="digit" id="hour-first">0</div>
        <div class="digit" id="hour-second">0</div>
    </div>
    <div class="separator">:</div>
    <div class="time-unit minutes">
        <div class="digit" id="minute-first">0</div>
        <div class="digit" id="minute-second">0</div>
    </div>
    <div class="separator">:</div>
    <div class="time-unit seconds">
        <div class="digit" id="second-first">0</div>
        <div class="digit" id="second-second">0</div>
    </div>
</div>

<style>
/* Clock container */
.clock {
    display: flex;
    justify-content: center;
    align-items: center;
    background: black;
    color: white;
    border-radius: 5px;
    font-family: sans-serif;
    width: 100%;
    height: 100%;
    overflow: hidden;
    padding: 0.5rem;
    gap: 0.3rem;
    box-sizing: border-box;
}

/* Time units (hours, minutes, seconds) */
.time-unit {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Separator styling */
.separator {
    display: flex;
    align-items: center;
    font-size: 2.5vw;
}

/* Digit styles */
.digit {
    font-size: 2.5vw;
    line-height: 1;
    position: relative;
    display: inline-block;
    transform-style: preserve-3d;
    perspective: 1000px;
}

/* Flip animation */
.flip-in {
    animation: flipIn 0.6s ease-in-out forwards;
}

.flip-out {
    animation: flipOut 0.6s ease-in-out forwards;
}

@keyframes flipIn {
    from {
        transform: rotateX(-90deg);
        opacity: 0;
    }
    to {
        transform: rotateX(0deg);
        opacity: 1;
    }
}

@keyframes flipOut {
    from {
        transform: rotateX(0deg);
        opacity: 1;
    }
    to {
        transform: rotateX(90deg);
        opacity: 0;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, "0");
        const minutes = String(now.getMinutes()).padStart(2, "0");
        const seconds = String(now.getSeconds()).padStart(2, "0");

        updateDigits("hour-first", hours[0]);
        updateDigits("hour-second", hours[1]);
        updateDigits("minute-first", minutes[0]);
        updateDigits("minute-second", minutes[1]);
        updateDigits("second-first", seconds[0]);
        updateDigits("second-second", seconds[1]);
    }

    function updateDigits(id, newDigit) {
        const element = document.getElementById(id);
        if (element.textContent !== newDigit) {
            element.classList.add("flip-out");
            setTimeout(() => {
                element.textContent = newDigit;
                element.classList.remove("flip-out");
                element.classList.add("flip-in");
            }, 300); // Delay to match the flip-out animation
        }
    }

    // Update the clock every second
    updateClock();
    setInterval(updateClock, 1000);
});
</script>
