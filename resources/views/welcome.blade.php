<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>River Monitoring System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("https://66.media.tumblr.com/a9c6c1b3d80e08b06069f8b7ed88d6b6/508c49d4521fd201-c0/s2048x3072/e73b44f8eeb8e10d0b575535b2a36db4b3f49e24.jpg");
                background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                background-color: #FFFFFFB3;
                width: 100%;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .credits {
                color: #FFFFFF;
                position: absolute;
                right: 30px;
                bottom: 30px;
            }

            .credits a{
                color: #FFFFFF;
                text-decoration: none;
            }

            .credits a:hover {
                color: #000000;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('admin/home') }}">Website</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title">
                    River Monitoring System
                </div>
            </div>
        </div>
        <div class="credits">
            Photo by <a href="https://unsplash.com/@martinsanchez">Martin Sanchez</a>
        </div>
    </body>
</html>
