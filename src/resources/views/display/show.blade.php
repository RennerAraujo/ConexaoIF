<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="refresh" content="300">
    <title>Conexão IF</title>

    <link rel="stylesheet" href="{{ asset('display/css/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('display/css/feather.css') }}">

    <style>
        .slide {
            display: none;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .slide.active {
            display: block;
            opacity: 1;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="lateral-bar">
            <div class="box-data-temp">
                <span id="dia"></span>
                <span id="mes"></span>
                <span id="ano"></span>
                <span id="hora"></span>
            </div>
            <div class="logo-ifma">
                <img src="{{ asset('display/img/logo-ifma.png') }}" alt="Logo IFMA">
            </div>
        </div>

        <div id="painel">
            @if ($programacaoAtiva && $programacaoAtiva->noticias->isNotEmpty())
                <div id="slideshow-container">
                    @foreach ($programacaoAtiva->noticias as $noticia)

                        @if($noticia->titulo && $noticia->texto)
                            <div class="slide noticia">
                                <h2>{{ $noticia->titulo }}</h2>
                                <p>{{ $noticia->texto }}</p>
                                @if($noticia->imagem_path_1)
                                    <img src="{{ Storage::url($noticia->imagem_path_1) }}" alt="">
                                @endif
                            </div>
                        @endif

                        @for ($i = 1; $i <= 5; $i++)
                            @php $fieldName = 'imagem_path_' . $i; @endphp
                            @if ($noticia->$fieldName)
                                <div class="slide noticia">
                                    <img src="{{ Storage::url($noticia->$fieldName) }}" alt="{{ $noticia->titulo }}">
                                </div>
                            @endif
                        @endfor
                    @endforeach
                </div>
            @else
                <div class="noticia" style="display: flex; align-items: center; justify-content: center; height:100vh;">
                    <h2 style="left: 0; position: relative; font-size: 2.5vw;">Nenhuma programação ativa para esta tela no
                        momento.</h2>
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('display/js/jquery.js') }}"></script>
    <script src="{{ asset('display/js/display.js') }}"></script>

</body>

</html>