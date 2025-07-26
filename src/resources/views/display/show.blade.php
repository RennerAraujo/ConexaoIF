<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Conexão IF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #1a202c;
            /* Fundo escuro */
            color: white;
            font-family: sans-serif;
        }

        .slide {
            width: 100vw;
            height: 100vh;
            display: none;
            /* Esconde todos os slides por padrão */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem;
            box-sizing: border-box;
            text-align: center;
        }

        .slide.active {
            display: flex;
            /* Mostra apenas o slide ativo */
        }

        .slide-image {
            max-height: 60vh;
            max-width: 90%;
            object-fit: contain;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }

        .slide-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .slide-text {
            font-size: 1.8rem;
            line-height: 1.6;
            max-width: 80ch;
        }

        .no-content {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 2.5rem;
        }
    </style>
</head>

<body>
    @if ($programacaoAtiva && $programacaoAtiva->noticias->isNotEmpty())
        <div id="slideshow-container">
            @foreach ($programacaoAtiva->noticias as $noticia)
                <div class="slide">
                    <h1 class="slide-title">{{ $noticia->titulo }}</h1>
                    <p class="slide-text">{{ $noticia->texto }}</p>
                </div>
                @for ($i = 1; $i <= 5; $i++) @php $fieldName = 'imagem_path_' . $i; @endphp @if ($noticia->$fieldName)
                        <div class="slide">
                            <img src="{{ Storage::url($noticia->$fieldName) }}" alt="{{ $noticia->titulo }}" class="slide-image">
                        </div>
                    @endif
                @endfor
            @endforeach
        </div>
    @else
        <div class="no-content">
            <span>Nenhuma programação ativa para esta tela no momento.</span>
        </div>
    @endif

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const slideInterval = 10000;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        if (slides.length > 0) {
            showSlide(0); // Mostra o primeiro slide
            setInterval(nextSlide, slideInterval); // Muda de slide a cada 10 segundos
        }
    </script>
</body>

</html>