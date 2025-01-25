<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('contents/clock/banner0.png') }}">
        <title>Banner</title>
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

            .moving-banner {
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
                font-size: calc(7vw + 7vh);
                white-space: nowrap;
                padding: 0px;
            }

            .banner-content {
                display: inline-block;
                animation: move-left 20s linear infinite;
                font-weight: bold;
            }

            @keyframes move-left {
                from {
                    transform: translateX(70%);
                }

                to {
                    transform: translateX(-70%);
                }
            }
        </style>
    </head>

    <body class='wrapper'>
        <div class="moving-banner">
            <pre class="banner-content">{{ $bannerTextString }}</pre>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const bannerElement = document.querySelector('.banner-content');
                const textLength = bannerElement.textContent.length;
                const animationDuration = textLength / 2;
                bannerElement.style.animation = `move-left ${animationDuration}s linear infinite`;

                function adjustWidgetDetails() {
                    const widget = document.querySelector('.moving-banner');
                    if (widget.offsetWidth <= window.parent.innerWidth * 20 / 100 && widget.offsetHeight > window
                        .parent.innerHeight * 20 / 100) {
                        widget.style.fontSize = 'calc(5.5vw + 5.5vh)';
                    } else if (widget.offsetWidth < 100 && widget.offsetHeight < 100) {
                        widget.style.fontSize = 'calc(10vw + 10vh)';
                    }
                }
                window.addEventListener('resize', adjustWidgetDetails);
            });
        </script>
    </body>

</html>
