<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css']) <!-- Ensure Vite is set up correctly -->
</head>
<body>
    <div id="app"></div>
</body>
</html>