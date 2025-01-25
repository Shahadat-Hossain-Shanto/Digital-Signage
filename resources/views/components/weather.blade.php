<style>
    .weather-widget {
        max-width: 100%; /* Ensures it doesn't exceed the parent div's width */
        max-height: 100%; /* Ensures it doesn't exceed the parent div's height */
        margin: auto;
        background: linear-gradient(to bottom right, #87CEEB, #1E90FF);
        color: #fff;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        font-family: Arial, sans-serif;
        width: 100%; /* Adapts to the parent div */
        height: 100%; /* Adapts to the parent div */
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden; /* Prevents content overflow */
    }

    .weather-widget img {
        max-width: 100%;
        height: auto;
        object-fit: contain; /* Keeps the aspect ratio of images */
    }

    .weather-widget .current-weather, 
    .weather-widget .additional-info {
        overflow: hidden; /* Ensures no content spills over */
    }

    .weather-widget h1, 
    .weather-widget h2, 
    .weather-widget p {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis; /* Truncates text that overflows */
    }

    /* Media query for extremely small containers */
    @media (max-width: 400px) {
        .weather-widget h1 {
            font-size: 6vw; /* Adjust font size */
        }
        .weather-widget h2 {
            font-size: 5vw;
        }
        .weather-widget p {
            font-size: 3vw;
        }
        .additional-info p {
            display: none; /* Hide additional info when container is too small */
        }
    }
    .mb-2 {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden; /* Prevents any overflow */
}

</style>

<div class="mb-2" style="width: 100%; height: 400px; border: 1px solid #ddd;">
    <div class="weather-widget">
        <div class="current-weather">
            <img id="weather-icon" src="" alt="Weather Icon">
            <h1 id="location">Loading...</h1>
            <h2 id="temperature">--°C</h2>
            <p id="description">--</p>
        </div>
        <div class="additional-info">
            <p id="humidity">Humidity: --%</p>
            <p id="wind-speed">Wind: --</p>
            <p id="visibility">Visibility: --</p>
            <p id="cloud-cover">Cloud Cover: --%</p>
            <p id="sunrise">Sunrise: --</p>
            <p id="sunset">Sunset: --</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const apiKey = 'c67d396cb70ac519f249830e6b025d4e';
        const apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
        const location = "Dhaka";

        const url = `${apiUrl}?q=${location}&appid=${apiKey}&units=metric`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Populate weather details
                document.getElementById('location').textContent = `${data.name}, ${data.sys.country}`;
                document.getElementById('temperature').textContent = `${Math.round(data.main.temp)}°C`;
                document.getElementById('description').textContent = data.weather[0].description;
                document.getElementById('humidity').textContent = `Humidity: ${data.main.humidity}%`;
                document.getElementById('wind-speed').textContent = `Wind: ${data.wind.speed} m/s`;
                document.getElementById('visibility').textContent = `Visibility: ${data.visibility / 1000} km`;
                document.getElementById('cloud-cover').textContent = `Cloud Cover: ${data.clouds.all}%`;
                document.getElementById('sunrise').textContent = `Sunrise: ${formatTime(data.sys.sunrise, data.timezone)}`;
                document.getElementById('sunset').textContent = `Sunset: ${formatTime(data.sys.sunset, data.timezone)}`;

                // Set weather icon
                const iconCode = data.weather[0].icon;
                document.getElementById('weather-icon').src = `http://openweathermap.org/img/wn/${iconCode}@2x.png`;

                // Adjust visibility for small widgets
                adjustWidgetDetails();
            })
            .catch(error => console.error('Error fetching weather data:', error));

        // Function to format time
        function formatTime(unixTime, timezone) {
            const date = new Date((unixTime + timezone) * 1000);
            return date.toISOString().substr(11, 5); // Format as HH:MM
        }

        // Function to hide additional details if widget is too small
        function adjustWidgetDetails() {
            const widget = document.querySelector('.weather-widget');
            const additionalInfo = document.querySelector('.additional-info');

            if (widget.offsetWidth < 300 || widget.offsetHeight < 300) {
                additionalInfo.style.display = 'none'; // Hide additional info if widget is too small
            } else {
                additionalInfo.style.display = 'flex'; // Show additional info for larger widgets
            }
        }

        // Listen to window resize for dynamic adjustments
        window.addEventListener('resize', adjustWidgetDetails);

        // Ensure widget fits parent container
        function adjustWidgetSize() {
            const widget = document.querySelector('.weather-widget');
            const parent = widget.parentElement;

            widget.style.maxWidth = `${parent.offsetWidth}px`;
            widget.style.maxHeight = `${parent.offsetHeight}px`;
        }

        // Call the adjustment function on load and resize
        adjustWidgetSize();
        window.addEventListener('resize', adjustWidgetSize);
    });
</script>