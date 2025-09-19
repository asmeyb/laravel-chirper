<!DOCTYPE html>
<html lang="en">
    <html lang="en" data-theme="laravelChirper">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    {{-- <meta property="og:image" content={{ asset('images/og.jpeg') }} /> --}}
    <meta property="og:title" content="Chirper" />
    <meta property="og:description"
        content="A demo social media platform highlighting the power and simplicity of Laravel." />
    <meta property="og:url" content="https://chirper.laravel.cloud" />
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body>
<main class="flex-1 container mx-auto px-4 py-8">
    <div class="card bg-base-100 shadow max-w-xl mx-auto">
        <div class="card-body">
            <h1 class="text-3xl font-bold">Welcome to Chirper!</h1>
            <p class="mt-4 text-base-content/60">This is a simple Laravel application.</p>
        </div>
    </div>
</main>

<footer class="footer footer-center p-4 bg-base-200 text-base-content">
    <div>
        <p>© 2025 Chirper. All rights reserved.</p>
    </div>
</footer>
</body>
</html>