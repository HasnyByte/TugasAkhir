<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-[#F9F9F9] font-sans">
<main class="flex-1">
    @include('components.navbar')
    <div>
        @yield('content')
    </div>
</main>
</body>
</html>
