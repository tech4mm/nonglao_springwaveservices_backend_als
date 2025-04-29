<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download APK</title>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        .animated-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color: white;
            animation: slideInFade 2s ease-in-out forwards;
        }

        @keyframes slideInFade {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            position: relative; z-index: 1;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px 20px;
        }

        .download-btn {
            padding: 15px 30px;
            background-color: #00a86b;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 0 15px rgba(0, 168, 107, 0.5);
            transition: all 0.4s ease-in-out;
            transform: scale(1);
        }

        .download-btn:hover {
            background-color: #007f53;
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(0, 168, 107, 0.8);
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f5f9;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 1s ease forwards;
        }

        .wave-bg {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 120px;
            overflow: hidden;
            line-height: 0;
        }

        .wave-bg svg {
            position: relative;
            display: block;
            width: calc(200% + 1.3px);
            height: 120px;
        }

        .wave-bg .wave {
            fill: #ff00cc;
        }

        /* Typewriter animation for heading */
        .typewriter h1 {
            overflow: hidden;
            border-right: .15em solid #00a86b;
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .05em;
            animation: typing 1s steps(30, end) 0s forwards, blink-caret 0.75s step-end infinite;
            animation-delay: 0s, 1s;
            animation-iteration-count: infinite, infinite;
            animation-duration: 22.5s, 0.75s;
            animation-direction: normal, normal;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #00a86b; }
        }

        @media (max-width: 768px) {
            header > div {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 10px;
            }

            main h1 {
                font-size: 20px;
                text-align: center;
            }

            .lottie-row {
                flex-direction: column !important;
                align-items: center !important;
            }

            .lottie-row lottie-player {
                margin-bottom: 20px;
            }

            .download-btn {
                width: 100%;
                max-width: 280px;
            }
            .animated-brand {
                font-family: 'Poppins', sans-serif;
                font-size: 20px;
                font-weight: 600;
                margin: 0;
                color: white;
                animation: slideInFade 2s ease-in-out forwards;
            }

            @keyframes slideInFade {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }
    </style>
</head>
<body>

<header style="background: linear-gradient(to right, #00a86b, #2ecc71); padding: 30px 40px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
    <div style="display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto;">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 50px;" class="fade-in">
        </div>
        <div style="flex: 1; text-align: center;">
            <p class="animated-brand">Nonglao &gt; Springwaveservices</p>
        </div>
        <div>
            <lottie-player
                src="https://assets1.lottiefiles.com/packages/lf20_h4th9ofg.json"
                background="transparent"
                speed="1"
                style="width: 80px; height: 80px;"
                loop
                autoplay>
            </lottie-player>
        </div>
    </div>
</header>

<main style="position: relative; z-index: 1;">
    <div class="typewriter">
        <h1>Download Our App</h1>
    </div>
    <div class="lottie-row" style="display: flex; justify-content: space-evenly; align-items: center; flex-wrap: wrap; gap: 20px; margin: 40px 0; max-width: 1000px; width: 100%; padding: 0 20px;">
        <lottie-player
            src="https://assets4.lottiefiles.com/packages/lf20_yr6zz3wv.json"
            background="transparent"
            speed="1"
            style="width: 100%; max-width: 300px; height: 300px;"
            loop
            autoplay>
        </lottie-player>

        <lottie-player
            src="https://assets10.lottiefiles.com/packages/lf20_tno6cg2w.json"
            background="transparent"
            speed="1"
            style="width: 100%; max-width: 300px; height: 300px;"
            loop
            autoplay>
        </lottie-player>
    </div>
    <div style="text-align: center;">
        <a href="{{ route('download.apk') }}" class="download-btn fade-in" style="animation-delay: 0.6s;">Download APK</a>
    </div>
</main>

<footer>
    &copy; {{ date('Y') }} Spring Wave Services. All rights reserved.
</footer>

<div class="wave-bg">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.13,103.2,29,158.2,17C230.77,49.92,284.71,18.6,339,6.86c70.09-15.2,136.25,9.3,206.22,29.77,63.29,18.49,127.6,36.31,190.13,22.52C791.58,48.18,851.81,6,914,0c70.52-6.92,135.63,20.84,200,46.29V0Z" class="wave"></path>
    </svg>
</div>

</body>
</html>