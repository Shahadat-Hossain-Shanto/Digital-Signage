<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('contents/clock/digital-clock-2.png') }}">
        <title>Digital clock 2</title>

        <style>
            @font-face {
                font-family: 'Digital-7';
                src: url('fonts/digital-7.ttf') format('woff2'), url('digital-7.woff') format('woff');
            }

            .wrapper {
                margin: auto;
                position: relative;
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
            }

            .clockdate-wrapper {
                width: 100%;
                height: 100vh;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                background: linear-gradient(to bottom right, #87CEEB, #1E90FF);
                /* background: #141E30; */
                /* background: linear-gradient(to right, #243B55, #141E30); */
                flex-direction: column;
                /* border-radius: 15px; */
                box-sizing: border-box;
                overflow: hidden;
            }

            #dateclock {
                font-family: Digital-7, sans-serif;
                font-size: calc(9.5vw + 9.5vh);
                ;
                color: #fff;
                text-shadow: 0px 0px 3px #fff;
                white-space: nowrap;
            }

            #date {
                letter-spacing: 0.1vw;
                font-size: calc(4vw + 4vh);
                font-family: Arial, sans-serif;
                color: #fff;
                white-space: nowrap;
                margin-top: 1vh;
            }
        </style>
    </head>

    <body class="wrapper">
        <div class='clockdate-wrapper'>
            <div id="dateclock"></div>
            <div id="date"></div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function checkParentHeight() {
                const parentElement = document.querySelector('.clockdate-wrapper');
                const dateclock = document.querySelector('#dateclock');
                const date = document.querySelector('#date');
                const parentHeight = parentElement.offsetHeight; // Get the height of the parent
                const parentWidth = parentElement.offsetWidth;

                if (parentHeight > window.parent.innerHeight * 20 / 100 && parentWidth <= window.parent
                    .innerWidth * 20 / 100) {
                    dateclock.style.fontSize = "calc(4.5vw + 4.5vh)";
                    date.style.fontSize = "calc(2.5vw + 2.5vh)";
                } else if (parentHeight <= window.parent.innerHeight * 20 / 100 && parentWidth > window.parent
                    .innerWidth * 20 / 100) {
                    dateclock.style.fontSize = "calc(7vw + 7vh)";
                    date.style.fontSize = "calc(3.5vw + 3.5vh)";
                } else if (parentHeight < 100 && parentWidth < 100) {
                    dateclock.style.fontSize = "calc(7.5vw + 7.5vh)";
                }
            }

            // Check the height once on page load
            checkParentHeight();

            // Optionally, check the height every time the window is resized
            window.addEventListener('resize', checkParentHeight);
        });

        function startTime() {
            const today = new Date();
            let hr = today.getHours();
            let min = today.getMinutes();
            let sec = today.getSeconds();
            const ap = hr < 12 ? "<span>AM</span>" : "<span>PM</span>";
            hr = hr == 0 ? 12 : hr;
            hr = hr > 12 ? hr - 12 : hr;

            hr = checkTime(hr);
            min = checkTime(min);
            sec = checkTime(sec);
            document.getElementById("dateclock").innerHTML = `${hr}:${min}:${sec} ${ap}`;

            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ];
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const curWeekDay = days[today.getDay()];
            const curDay = today.getDate();
            const curMonth = months[today.getMonth()];
            const curYear = today.getFullYear();
            const date = `${curWeekDay}, ${curDay} ${curMonth} ${curYear}`;
            document.getElementById("date").innerHTML = date;

            setTimeout(startTime, 500);
        }

        function checkTime(i) {
            return i < 10 ? "0" + i : i;
        }

        startTime();
    </script>

</html>
