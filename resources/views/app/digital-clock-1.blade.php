<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('contents/clock/digital-clock-1.png') }}">
        <title>Digital clock 1</title>
        <style>
            /* Clock container */
            .parent {
                margin: auto;
                position: relative;
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
            }

            /* Clock element that fills the parent */
            .clock {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                /* background: black; */
                background: linear-gradient(to bottom right, #87CEEB, #1E90FF);
                color: white;
                /* border-radius: 15px; */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                box-sizing: border-box;
                font-family: sans-serif;
                font-size: calc(13vw + 13vh);
                overflow: hidden;
                gap: 0.3rem;
                position: relative;
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
                font-size: inherit;
            }

            /* Digit styles */
            .digit {
                font-size: inherit;
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
    </head>

    <body class='parent'>
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
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function checkParentHeight() {
                const parentElement = document.querySelector('.clock');
                const parentHeight = parentElement.offsetHeight; // Get the height of the parent
                const parentWidth = parentElement.offsetWidth;
                if (parentHeight > window.parent.innerHeight * 20 / 100 && parentWidth <= window.parent
                    .innerWidth * 20 / 100) {
                    parentElement.style.fontSize = "calc(6.5vw + 6.5vh)";
                } else if (parentHeight < 100 && parentWidth < 100) {
                    parentElement.style.fontSize = "calc(7vw + 7vh)";
                }
            }

            // Check the height once on page load
            checkParentHeight();

            // Optionally, check the height every time the window is resized
            window.addEventListener('resize', checkParentHeight);
        });


        document.addEventListener("DOMContentLoaded", function() {
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

</html>
