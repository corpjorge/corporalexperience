<?php $fondo = rand(1, 7); ?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CorporalExp</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff;
                background-image: url("https://k11.kn3.net/965EAC637.jpg");*/
                width: 100%
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
              /*  right: 10px;*/
                left: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            #logo{
              transition:all .5s ease-in-out;
             }
            #logo:hover{
             display: 0;
             filter: saturate(295%);
             -webkit-transform:scale(1.3);transform:scale(1.3);
           }
           #login{
                 color: #000000;
                 font-size: 20px;
           }
           #fondo{
             width: 100%;
             position: fixed;
           }

           @media screen and (max-width: 480px) {
             #fondo{
               width: auto;
               height: 127%;
             }
          }

          @media screen and (max-width: 1400px) {
            #fondo{
              width: 100%;
              height: 100%;
            }
         }

         @media screen and (max-width: 800px) {
           #fondo{
             width: auto;
             height: 100%;
           }
        }

        </style>
    </head>
    <body>
      <img id="fondo" src="{{ asset('img/fondos/'.$fondo)}}.jpg" class="lento" style="display: none;">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a id="login" href="{{ url('/home') }}">Home</a>
                    @else
                        <a id="login" href="{{ route('login') }}"><b>Login</b></a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="container">
                    <img src="{{ asset('img/corporalexp.png')}}" class="img-responsive lento" id="logo" alt="Logo" width="304" style="display: none;" >
                </div>


            </div>
        </div>
    </body>

<script>
window.onload = function() {

  $(".lento").css({
    "opacity":"0",
    "display":"",
  }).show().animate({opacity:2})

};


</script>


</html>
