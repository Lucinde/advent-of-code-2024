<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50 p-3 bg-green-900">
        <x-card 
            title="Day 1"
            part1Result="{{ $day1 }}"
            part2Result="{{ $day1PartTwo }}"
        />
        <x-card 
            title="Day 2"
            part1Result="{{ $day2 }}"
            part2Result="Not enough time"
        />
        <x-card 
            title="Day 3"
            part1Result="{{ $day3 }}"
            part2Result="{{ $day3PartTwo }}"
        />
        <x-card 
            title="Day 4"
            part1Result="{{ $day4 }}"
            part2Result="{{ $day4PartTwo }}"
        />
    </body>
</html>
