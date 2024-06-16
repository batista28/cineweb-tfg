<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logoCineWeb.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <title>CineWeb</title>
    <!-- Otros enlaces a CSS si es necesario -->

    <!-- Estilos adicionales para el header -->
    <style>
        /* Estilos para el header */
        .header,
        .header1,
        nav a,
        .listapeliculas-container,
        .listapeliculas-container h2,
        table,
        th,
        td,
        .pagination,
        .pagination-container,
        .resultado,
        .footer,
        .footer-wrapper,
        .footer-links,
        .footer-links a,
        .social-links,
        .buscar-label,
        .ordenar-label,
        .ordenar-select,
        .buscar-input,
        label,
        select#orderField,
        p,
        span {
            font-family: 'Inter', Arial, sans-serif;
        }

        .header {
            background-color: #253340;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            overflow: hidden;
            margin-top: -10px;
            margin-left: -17px;
            gap: -50px;
        }

        .header1 {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        nav a {
            margin-right: 5px;
            color: white;
            text-decoration: none;
        }

        nav a:hover {
            color: #ddd;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            background-color: #343a40;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
        }

        .card-body {
            padding: 20px;
        }

        .card-img-top {
            max-width: 100%;
            height: auto;
        }

        .carousel {
            margin-top: 20px;
        }

        .carousel-item {
            display: none;
        }

        .carousel-item:first-child {
            display: block;
        }

        .container {
            font-family: 'Inter', Arial, sans-serif;
            margin: 20px auto;
            width: calc(100% - 40px);
            max-height: calc(100vh - 200px);
        }

        .content-with-margins {
            margin-top: 20px;
            margin-bottom: 100px;
            padding-bottom: 100px;
        }

        .footer {
            background-color: #253340;
            padding: 1rem;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
            margin: 0 auto;
            z-index: 1000;
        }

        .footer-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .footer-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 10px;
                font-size: 12px;
            }

            .social-links {
                gap: 5px;
            }

            .footer-links a {
                font-size: 12px;
            }

            .social-links img {
                width: 24px;
            }
        }

        body {
            background-color: #1B2026;
            text-align: center;
            padding-bottom: 0px;
        }

        span {
            color: white;
        }

        .card-body {
            position: relative;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .select-container {
            position: relative;
        }

        .select-arrow {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .calificacion-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calificacion-form button:hover {
            background-color: #0056b3;
        }

        .puntuacion-media-card {
            margin: 20px auto;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            width: 10%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 3px;
            min-height: 20px;
        }

        .calificacion-form {
            position: absolute;
            top: 0px;
            right: -10px;
            background-color: #4b89a2;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: white;
        }

        p {
            color: white;
        }

        .social-links img {
            width: 30px;
        }

        .card-body .col-md-8 {
            padding-right: 15px;
        }

        .recomendaciones {
            position: absolute;
            bottom: 0;
            left: -10px;
            background-color: #4b89a2;
            border-radius: 5px;
            padding: 10px;
            font-size: 12px;
            max-width: 200px;
            box-sizing: border-box;
            z-index: 1;
        }

        .container-div {
            margin-right: 20px;
        }

        .card-body {
            position: relative;
            display: flex;
        }

        .card-body>div {
            max-width: calc(100% - 220px);
            margin-left: 220px;
        }

        .recomendaciones h3,
        .recomendaciones h4,
        h2 {
            color: white;
        }

        .recomendaciones img {
            width: 70px;
            height: auto;
            margin-right: 10px;
        }

        img {
            width: 90px;
            height: auto;
        }

        .card-img-top {
            width: 150px;
            height: auto;
        }

        .card-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #cceeff;
            padding: 10px;
        }

        .btn-style {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            background-color: #049dbf;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-style:hover {
            background-color: #034e5f;
        }

        .btn-style a {
            color: inherit;
            text-decoration: none;
        }

        /* Añadir margen inferior al contenido para evitar que el footer lo cubra */
        .content-with-margins {
            margin-top: 20px;
            margin-bottom: 300px;
            /* Ajusta este valor según sea necesario */
            padding-bottom: 100px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header1">
            <img src="{{ asset('img/logoCineWeb.jpeg') }}" alt="Imagen de logoCineWEB" class="logo" />
            <h1>CineWeb</h1>
        </div>
        <nav>
            <a href="{{ route('peliculas.index') }}" style="margin-right: 10px;">Peliculas</a>
            <a href="{{ route('series.index') }}" style="margin-right: 10px;">Series</a>
            <a href="{{ route('listas.index') }}" style="margin-right: 10px;">Listas</a>

            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button class='btn-style' type="submit">Cerrar
                        sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrarse</a>
                @endif
            @endauth
    </header>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Botones o elementos de la barra de navegación a la derecha -->
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4 content-with-margins">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-wrapper">
            <div class="footer-links">
                <!-- Enlaces de pie de página -->
                <a href="{{ route('contacto.form') }}" style="margin-right: 10px;">Contacto</a>
                <a href="{{ route('about-us') }}" style="margin-right: 10px;">Sobre nosotros</a>
                <a href="{{ route('politicaprivacidad') }}" style="margin-right: 10px;">Politica de Privacidad</a>
            </div>
            <div class="social-links">
                <a href="#" title="Instagram">
                    <img src="{{ asset('img/Instagram.png') }}" alt="Instagram" />
                </a>
                <a href="https://www.facebook.com/DaviDiaz.Cine/" title="Facebook">
                    <img src="{{ asset('img/facebook.png') }}" alt="Facebook" />
                </a>
                <a href="https://twitter.com/?lang=es" title="Twitter">
                    <img src="{{ asset('img/x.png') }}" alt="Twitter" />
                </a>
                <a href="#" title="LinkedIn">
                    <img src="{{ asset('img/linkledin.png') }}" alt="LinkedIn" />
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>