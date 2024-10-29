<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
       
        html, body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-yellow-500 leading-tight">
            {{ __('Admin page') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg sm:rounded-lg overflow-hidden">
                <div class="p-6 text-yellow-500">
                    
            
                    
                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>
