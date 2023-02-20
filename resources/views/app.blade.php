<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <title inertia>{{ config('app.name', 'Laravel') }}</title>

 <!-- Fonts -->
 <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&family=Poppins&display=swap" rel="stylesheet">

 <!-- Font Awesome -->
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css'
  integrity='sha512-+ouAqATs1y4kpPMCHfKHVJwf308zo+tC9dlEYK9rKe7kiP35NiP+Oi35rCFnc16zdvk9aBkDUtEO3tIPl0xN5w=='
  crossorigin='anonymous' />

 <!-- Scripts -->
 @routes
 @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue", 'resources/css/app.css'])
 @inertiaHead
</head>

<body class="font-sans antialiased">
 @inertia
</body>

</html>
