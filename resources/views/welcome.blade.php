<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casino Royale</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white overflow-hidden ">

    <nav class="bg-gray-900 py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-yellow-500">Casino Royale</a>
            </div>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-white hover:text-yellow-500">Log In</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-white hover:text-yellow-500">Register</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section class="h-screen flex items-center justify-center bg-cover bg-center">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Casino Royale Logo" class="mx-auto mb-6 w-40 h-40">
            
            <h1 class="text-4xl font-extrabold text-yellow-500 mb-4">Welcome to Casino Royale</h1>
            <p class="text-lg mb-6">Your ultimate destination for thrilling games and exciting rewards. Spin the wheel, place your bets, and let the games begin!</p>
            <div class="space-x-4">
                @auth
                    <!-- If logged in, show a button to redirect to the dashboard -->
                    <a href="{{ url('/dashboard') }}" class="bg-yellow-500 text-black px-6 py-3 rounded-md text-lg font-semibold hover:bg-yellow-600 transition">Dashboard</a>
                @else
                    <!-- Show log in and register buttons for guests -->
                    <a href="{{ route('login') }}" class="bg-yellow-500 text-black px-6 py-3 rounded-md text-lg font-semibold hover:bg-yellow-600 transition">Log In</a>
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-yellow-500 text-yellow-500 px-6 py-3 rounded-md text-lg font-semibold hover:bg-yellow-500 hover:text-black transition">Register</a>
                @endauth
            </div>
        </div>
    </section>

</body>
</html>
