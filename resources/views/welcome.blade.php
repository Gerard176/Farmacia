<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Farmacia</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Styles -->
        
    </head>
    <body class="font-sans antialiased dark:text-white/50">
    <header class="bg-light py-4 d-flex justify-content-between align-items-center">
        <div class="ml-3">
            <img src="{{ asset('backend/dist/img/Drogueria-300x300.png') }}" alt="Logo Droguería" width="50px">
        </div>
        @if (Route::has('login'))
            <nav class="mr-3">
                @auth
                    <a href="{{ route('home') }}" class="text-dark mx-2 text-decoration-none">Página principal</a>
                @else
                    <a href="{{ route('login') }}" class="text-dark mx-2 text-decoration-none">Ingresar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-dark mx-2 text-decoration-none">Registrarse</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">Bienvenidos a Nuestra Farmacia</h1>
            <p class="lead">Su salud es nuestra prioridad. Ofrecemos una amplia variedad de productos y servicios para satisfacer sus necesidades.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}" role="button">Ver Productos</a>
        </div>

        <div class="row my-5">
            <div class="col-md-4">
                <h3>Productos Destacados</h3>
                <p>Conozca nuestros productos más populares.</p>
            </div>
            <div class="col-md-4">
                <h3>Testimonios</h3>
                <p>Lo que dicen nuestros clientes.</p>
            </div>
            <div class="col-md-4">
                <h3>Contacto</h3>
                <p>Visítenos o contáctenos para más información.</p>
            </div>
        </div>

        <div class="text-center">
            <a href="#" class="btn btn-info mx-2">Facebook</a>
            <a href="#" class="btn btn-info mx-2">Twitter</a>
            <a href="#" class="btn btn-info mx-2">Instagram</a>
        </div>

    </div>

    <footer class="bg-light py-4 text-center">
        <p class="mb-0">Horario de Atención: Lunes a Viernes, 8 AM - 8 PM | Sábado y Domingo, 9 AM - 5 PM</p>
        <p class="mb-0">Dirección: Calle Falsa 123, Ciudad, País</p>
    </footer>
</body>

</html>
