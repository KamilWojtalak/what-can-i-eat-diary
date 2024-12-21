<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>
        <ul class="flex container mx-auto">
            <li class="mr-6">
                <a href="{{ route('days.index') }}">
                    Lista dni
                </a>
            </li>
            <li class="mr-6">
                <a href="{{ route('days.create') }}">
                    Stwórz dzień
                </a>
            </li>
        </ul>

        <hr>

        <div class="container mx-auto">
            {{ $slot }}
        </div>
        </p>
    </div>
</body>

</html>
