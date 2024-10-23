<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-yellow-500 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                <div class="p-6 text-yellow-500">
                    <h3 class="text-4xl font-extrabold mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="text-lg">Remember, 99% of gamblers quit before they hit a big jackpot...</p>
                </div>
            </div>
        </div>
    </div>

    <nav class="bg-gray-900 py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Add content here if needed -->
            <div class="flex items-center"></div>
            <div class="flex items-center space-x-4"></div>
        </div>
    </nav>

    <!-- Add a placeholder for chat messages -->
    <div id="chat-messages" class="p-6 text-white">
        <h4 class="text-2xl mb-4">Chat Messages:</h4>
        <!-- Messages will appear here -->
    </div>

    <!-- Add Laravel Echo script for real-time events -->
   @vite('resources/js/app.js')
    <script>
        // Make sure Echo is initialized correctly (ensure you have included Laravel Echo setup in your 'resources/js/app.js')
        
            window.Echo.channel('chat')
                .listen('MessagingEvent', (e) => {
                    console.log(e);
                })
        
    </script>
</x-app-layout>
