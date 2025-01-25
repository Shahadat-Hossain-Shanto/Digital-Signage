<div id="clockdate">
    <div class="clockdate-wrapper">
        <div id="dateclock"></div>
        <div id="date"></div>
    </div>
</div>

<style>
    @font-face {
        font-family: 'Digital-7';
        src: url('fonts/digital-7.ttf') format('woff2'), b, g, mdrx url('digital-7.woff') format('woff');
    }

    /* Wrapper for the clock and date */
    .clockdate-wrapper {
        background: #141E30;
        background: linear-gradient(to right, #243B55, #141E30);
        padding: 5% 10%; /* Responsive padding */
        width: 100%;
        max-width: 100%;
        height: 100%;  /* Adjust height to the parent container */
        text-align: center;
        border-radius: 5px;
        margin: 0 auto;
        box-sizing: border-box;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Time clock style */
    #dateclock {
        font-family: Digital-7, sans-serif;
        color: #fff;
        text-shadow: 0px 0px 1px #fff;
        margin-bottom: 1vh;
        white-space: nowrap;
        transition: font-size 0.2s ease-in-out; /* Smooth transition for font size */
    }

    /* The date style */
    #date {
        letter-spacing: 0.1vw;
        font-size: 14px;
        font-family: Arial, sans-serif;
        color: #fff;
        white-space: nowrap;
    }
</style>

<script>
    // Function to update time (clock)
    function startTime() {
        var today = new Date();
        var hr = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();
        ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
        hr = (hr == 0) ? 12 : hr;
        hr = (hr > 12) ? hr - 12 : hr;
        // Add a zero in front of numbers < 10
        hr = checkTime(hr);
        min = checkTime(min);
        sec = checkTime(sec);
        document.getElementById("dateclock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var curWeekDay = days[today.getDay()];
        var curDay = today.getDate();
        var curMonth = months[today.getMonth()];
        var curYear = today.getFullYear();
        var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
        document.getElementById("date").innerHTML = date;

        var time = setTimeout(function () {
            startTime()
        }, 500);
    }

    // Function to add a zero in front of single digit numbers
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    // Resize observer to monitor the parent div's size
    const clockWrapper = document.querySelector('.clockdate-wrapper');
    const dateClock = document.getElementById("dateclock");

    const resizeObserver = new ResizeObserver(() => {
        adjustFontSize(clockWrapper, dateClock);
    });

    resizeObserver.observe(clockWrapper); // Observe the clock container

    // Function to adjust font size based on parent div size
    function adjustFontSize(wrapper, clock) {
        const width = wrapper.offsetWidth;
        const height = wrapper.offsetHeight;
        const fontSize = Math.min(width, height) / 5; // Font size is 1/5th of the smallest dimension

        clock.style.fontSize = `${fontSize}px`;
    }

    // Start the clock
    startTime();
</script>
