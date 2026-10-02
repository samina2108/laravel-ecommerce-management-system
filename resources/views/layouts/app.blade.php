<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

```
<title>{{ config('app.name', 'Laravel E-Commerce') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
```

</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

```
<div class="min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Page Header --}}
    @isset($header)
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Main Content --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center">
            <h3 class="text-xl font-semibold text-white">
                Laravel E-Commerce
            </h3>

            <p class="mt-2 text-sm">
                Shop quality products at affordable prices.
            </p>

            <p class="mt-4 text-xs text-gray-400">
                © {{ date('Y') }} Laravel E-Commerce. All rights reserved.
            </p>
        </div>
    </footer>

</div>
```

</body>
</html>
