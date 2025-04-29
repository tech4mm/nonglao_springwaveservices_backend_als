<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- LottiePlayer -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #f0f2f5);
            text-align: center;
            overflow: hidden;
        }

        .content {
            padding: 30px;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #3490dc, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #555;
        }

        a {
            display: inline-block;
            padding: 12px 24px;
            background: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a:hover {
            background: #2779bd;
            transform: scale(1.05);
        }

        lottie-player {
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        footer {
            margin-top: auto;
            padding: 20px;
            background: #222;
            color: #bbb;
            font-size: 0.9rem;
            width: 100%;
            text-align: center;
        }
    </style>

</head>
<body>

    <div class="content">
        <!-- Lottie Animation -->
        <lottie-player 
            src="https://assets4.lottiefiles.com/packages/lf20_qp1q7mct.json"  
            background="transparent"  
            speed="1"  
            style="width: 300px; height: 300px;"  
            loop  
            autoplay>
        </lottie-player>

        <h1>Oops! Page Not Found</h1>
        <p>We're redirecting you to the homepage in <span id="countdown">5</span> seconds...</p>
        <a href="/">Go Home Now</a>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');

        const interval = setInterval(function() {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }
            if (countdown <= 0) {
                clearInterval(interval);
            
                window.location.href = "/";
            }
        }, 1000);
    });
</script>
</html>