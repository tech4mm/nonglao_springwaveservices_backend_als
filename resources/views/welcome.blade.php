<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download APK</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
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

        header {
            padding: 20px;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        header img {
            max-height: 60px;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px 20px;
        }

        .download-btn {
            padding: 15px 30px;
            background-color: #2563eb;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .download-btn:hover {
            background-color: #1e40af;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f5f9;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
</header>

<main>
    <h1>Download Our App</h1>
    <a href="{{ route('download.apk') }}" class="download-btn">Download APK</a>
</main>

<footer>
    &copy; {{ date('Y') }} Spring Wave Services. All rights reserved.
</footer>

</body>
</html>
