<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('contents/clock/weather.jpg') }}">
        <title>Weather</title>
        <style>
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

            .weather-widget {
                position: relative;
                width: 100%;
                height: 100%;
                margin: auto;
                background: linear-gradient(to bottom right, #87CEEB, #1E90FF);
                color: #fff;
                text-align: center;
                /* border-radius: 15px; */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                font-family: Arial, sans-serif;
                box-sizing: border-box;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                overflow: hidden;
                font-size: calc(1.5vw + 1.5vh);
            }

            .weather-widget img {
                max-width: 100%;
                height: auto;
                object-fit: contain;
            }

            .weather-widget .current-weather,
            .weather-widget .additional-info {
                overflow: hidden;
            }

            .additional-info {
                display: flex;
            }

            .weather-widget h1,
            .weather-widget h2,
            .weather-widget p {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .additional-info-icon {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>

    <body class='wrapper'>
        <div class="weather-widget">
            <div class="current-weather">
                {{-- <img id="weather-icon" src="" alt="Weather Icon"> --}}
                <h1 id="location">Loading...</h1>
                <h2 id="temperature">--°C</h2>
                <p id="description">--</p>
            </div>
            <div class="additional-info">
                <p class="additional-info-icon" id="humidity"><img src="{{ asset("assets/img/app/humidity.png") }}"
                        class="img-icon" alt="Humidity" width="80"> : --%</p>&nbsp
                <p class="additional-info-icon" id="wind-speed"><img src="{{ asset("assets/img/app/wind.png") }}"
                        class="img-icon" alt="Wind" width="80"> : --</p>&nbsp
                <p class="additional-info-icon" id="visibility"><img
                        src="{{ asset("assets/img/app/low-visibility.png") }}" class="img-icon" alt="Visibility"
                        width="80"> : --</p>&nbsp
                <p class="additional-info-icon" id="cloud-cover"><img src="{{ asset("assets/img/app/cloud-sky.png") }}"
                        class="img-icon" alt="Cloud Cover" width="80"> : --%</p>&nbsp
                <p class="additional-info-icon" id="sunrise"><img src="{{ asset("assets/img/app/sunrise.png") }}"
                        class="img-icon" alt="Sunrise" width="80"> : --</p>&nbsp
                <p class="additional-info-icon" id="sunset"><img src="{{ asset("assets/img/app/sunset.png") }}"
                        class="img-icon" alt="Sunset" width="80"> : --</p>
            </div>
        </div>

        <script>
            const humidityImageSrc = "{{ asset("assets/img/app/humidity.png") }}";
            const windImageSrc = "{{ asset("assets/img/app/wind.png") }}";
            const visibilityImageSrc = "{{ asset("assets/img/app/low-visibility.png") }}";
            const cloudCoverImageSrc = "{{ asset("assets/img/app/cloud-sky.png") }}";
            const sunriseCoverImageSrc = "{{ asset("assets/img/app/sunrise.png") }}";
            const sunsetCoverImageSrc = "{{ asset("assets/img/app/sunset.png") }}";

            document.addEventListener('DOMContentLoaded', () => {
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
                        document.getElementById('description').textContent = data.weather[0].main + ' : ' + data
                            .weather[0].description;

                        document.getElementById('humidity').textContent = '';
                        document.getElementById('humidity').innerHTML =
                            `
                                <img src="${humidityImageSrc}" class="img-icon" alt="Humidity" width="80"> : ${data.main.humidity}%`;
                        document.getElementById('wind-speed').textContent = '';
                        document.getElementById('wind-speed').innerHTML =
                            `<img src="${windImageSrc}" class="img-icon" alt="Wind" width="80"> : ${data.wind.speed} m/s`;

                        document.getElementById('visibility').textContent = '';
                        document.getElementById('visibility').innerHTML =
                            `<img src="${visibilityImageSrc}" class="img-icon" alt="Visibility" width="80"> : ${data.visibility / 1000} km`;

                        document.getElementById('cloud-cover').textContent = '';
                        document.getElementById('cloud-cover').innerHTML =
                            `<img src="${cloudCoverImageSrc}" class="img-icon" alt="Cloud Cover" width="80"> : ${data.clouds.all}%`;

                        document.getElementById('sunrise').textContent = '';
                        document.getElementById('sunrise').innerHTML =
                            `<img src="${sunriseCoverImageSrc}" class="img-icon" alt="Sunrise" width="80"> : ${formatTime(data.sys.sunrise, data.timezone)}`;

                        document.getElementById('sunset').textContent = '';
                        document.getElementById('sunset').innerHTML =
                            `<img src="${sunsetCoverImageSrc}" class="img-icon" alt="Sunset" width="80"> : ${formatTime(data.sys.sunset, data.timezone)}`;

                        // document.getElementById('humidity').textContent =
                        //     `<img src="{{ asset("assets/img/app/humidity.png") }}" class="img-icon" alt="Humidity" width="80"> : ${data.main.humidity}%`;
                        // document.getElementById('wind-speed').textContent = `Wind: ${data.wind.speed} m/s `;
                        // document.getElementById('visibility').textContent =
                        //     `Visibility: ${data.visibility / 1000} km `;
                        // document.getElementById('cloud-cover').textContent = `Cloud Cover: ${data.clouds.all}% `;
                        // document.getElementById('sunrise').textContent =
                        // `Sunrise: ${formatTime(data.sys.sunrise, data.timezone)} `;
                        // document.getElementById('sunset').textContent =
                        //     `Sunset: ${formatTime(data.sys.sunset, data.timezone)}`;

                        // Set weather icon
                        // const iconCode = data.weather[0].icon;
                        // document.getElementById('weather-icon').src =
                        //     `http://openweathermap.org/img/wn/${iconCode}@2x.png`;

                        // Adjust visibility for small widgets
                        adjustWidgetDetails();
                    })
                    .catch(error => console.error('Error fetching weather data:', error));

                // Function to format time
                function formatTime(timestamp, timezoneOffset) {
                    // Create a Date object from the Unix timestamp (milliseconds)
                    const date = new Date((timestamp) * 1000);

                    // Get the hours and minutes from the Date object
                    let hours = date.getHours();
                    let minutes = date.getMinutes();

                    // Determine AM or PM
                    const period = hours >= 12 ? 'PM' : 'AM';
                    // Convert to 12-hour format
                    hours = hours % 12;
                    hours = hours ? hours : 12; // The hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero if needed

                    // Format the time as HH:MM AM/PM
                    return `${hours}:${minutes} ${period}`;
                }
                // Function to hide additional details if widget is too small
                function adjustWidgetDetails() {
                    const widget = document.querySelector('.weather-widget');
                    const additionalInfo = document.querySelector('.additional-info');

                    if (widget.offsetWidth <= window.parent.innerWidth * 20 / 100 || widget.offsetHeight <= window
                        .parent.innerHeight * 20 / 100) {
                        additionalInfo.style.display = 'none'; // Hide additional info if widget is too small

                        if (widget.offsetWidth <= window.parent.innerWidth * 20 / 100 && widget.offsetHeight <= window
                            .innerHeight * 20 / 100) {
                            widget.style.fontSize = 'calc(3.5vw + 3.5vh)';
                        } else if (widget.offsetWidth <= window.parent.innerWidth * 20 / 100) {
                            widget.style.fontSize = 'calc(2.5vw + 2.5vh)';
                        } else if (widget.offsetHeight <= window.parent.innerHeight * 20 / 100) {
                            // widget.style.fontSize = 'calc(1.5vw + 1.5vh)';
                            additionalInfo.style.display = 'flex';
                            document.querySelectorAll('.weather-widget *').forEach(function(element) {
                                element.style.margin = '0px';
                            });
                        }
                    } else {
                        additionalInfo.style.display = 'flex'; // Show additional info for larger widgets
                    }
                }

                window.addEventListener('resize', adjustWidgetDetails);
            });
        </script>
    </body>

</html>
