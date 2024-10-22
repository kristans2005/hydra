<x-app-layout>
    <nav class="bg-gray-900 py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-2xl font-bold text-yellow-500">Casino Royale Classic Slot</div>
            </div>
            <div class="flex items-center space-x-4">
            </div>
        </div>
    </nav>

    <x-slot name="header">
        
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <x-slot-machine />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
