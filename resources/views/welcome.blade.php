<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistema Integral CRUD') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles básicos -->
        <style>
            body {
                font-family: 'instrument-sans', sans-serif;
                background-color: #f3f4f6;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 0;
            }
            .title {
                font-size: 24px;
                font-weight: bold;
                color: #1f2937;
            }
            .nav a {
                margin-left: 15px;
                color: #4b5563;
                text-decoration: none;
            }
            .nav a:hover {
                color: #1f2937;
            }
            .content {
                background-color: white;
                border-radius: 8px;
                padding: 20px;
                margin-top: 20px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }
            .footer {
                text-align: center;
                margin-top: 40px;
                padding: 20px 0;
                color: #6b7280;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="title">Sistema Integral CRUD</div>
                <div class="nav">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            
            <div class="content">
                <h1 style="text-align: center; font-size: 28px; margin-bottom: 20px;">Bienvenido al Sistema Integral CRUD Multimodular</h1>
                <p style="text-align: center; margin-bottom: 30px;">Plataforma universitaria para gestión de información en múltiples áreas</p>
                
                <p style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('login') }}" style="background-color: #3b82f6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                        Iniciar sesión para acceder al sistema
                    </a>
                </p>
            </div>
            
            <div class="footer">
                <p>© {{ date('Y') }} Sistema Integral CRUD Multimodular. Todos los derechos reservados.</p>
                <p>Desarrollado como proyecto universitario</p>
            </div>
        </div>
    </body>
</html>