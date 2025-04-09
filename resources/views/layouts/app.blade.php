<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnergySmart Web</title>
    <!-- Enlace a TailwindCSS vía CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Puedes agregar tus propios estilos o scripts adicionales -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        @yield('content')
    </div>
</body>
</html>
