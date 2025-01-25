<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('contents/clock/digital-clock-3.png') }}">
        <title>Digital clock 3</title>

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
                background: linear-gradient(to bottom right, #87CEEB, #1E90FF);
            }
        </style>
    </head>

    <body class='wrapper'>
    </body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let size = 'large';
            const parentElement = document.querySelector('.wrapper');
            const parentHeight = parentElement.offsetHeight; // Get the height of the parent
            const parentWidth = parentElement.offsetWidth;
            if (parentHeight < 100 && parentWidth < 100) {
                size = 'small';
            }

            const iframe = document.createElement('iframe');
            iframe.id = 'dynamic-iframe';
            iframe.src =
                'https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=' + size +
                '&timezone=Asia%2FDhaka';
            iframe.frameBorder = '0';
            iframe.seamless = true;
            iframe.style.width = '100%';
            iframe.style.overflow = 'hidden';
            document.body.appendChild(iframe);
        });
    </script>

</html>
