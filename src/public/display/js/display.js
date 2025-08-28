$(document).ready(function () {
    var arrayMes = [
        "JAN",
        "FEV",
        "MAR",
        "ABR",
        "MAI",
        "JUN",
        "JUL",
        "AGO",
        "SET",
        "OUT",
        "NOV",
        "DEZ",
    ];
    function atualizarData() {
        var dataAtual = new Date();
        var dia = dataAtual.getDate();
        var mes = arrayMes[dataAtual.getMonth()];
        var ano = dataAtual.getFullYear();
        $("#dia").text(dia);
        $("#mes").text(mes);
        $("#ano").text(ano);
    }
    function atualizaHora() {
        var d = new Date(),
            displayDate;
        displayDate = d.toLocaleTimeString("pt-BR", {
            hour12: false,
            timeZone: "America/Sao_Paulo",
        });
        $("#hora").html(displayDate);
    }
    atualizarData();
    setInterval(atualizaHora, 1000);

    const noticias = $(".slide.noticia");
    const tempoPorImagem = 7000;
    const tempoFade = 1500;

    if (noticias.length === 0) return;

    let noticiaAtualIndex = 0;
    let imagemAtualIndex = 0;

    function animarEntradaTexto(noticiaElement) {
        const h2 = noticiaElement.find("h2");
        const p = noticiaElement.find("p");
        if (h2.length > 0) {
            h2.css("left", "-90vw").animate({ left: "2vw" }, 1500);
            p.css("left", "90vw").animate({ left: "2vw" }, 1500);
        }
    }

    function animarSaidaTexto(noticiaElement, callback) {
        const h2 = noticiaElement.find("h2");
        const p = noticiaElement.find("p");
        if (h2.length > 0 && p.length > 0) {
            h2.animate({ left: "90vw" }, 800);
            p.animate({ left: "-90vw" }, 800, function () {
                callback();
            });
        } else {
            callback();
        }
    }

    function proximoSlide() {
        let noticiaAtual = $(noticias[noticiaAtualIndex]);
        let imagens = noticiaAtual.find(".imagens-noticia img");

        if (imagens.length > 0) {
            imagens.eq(imagemAtualIndex).removeClass("active zooming");
        }

        imagemAtualIndex++;

        if (imagens.length === 0 || imagemAtualIndex >= imagens.length) {
            animarSaidaTexto(noticiaAtual, function () {
                noticiaAtual.removeClass("active");
                noticiaAtualIndex = (noticiaAtualIndex + 1) % noticias.length;
                let proximaNoticia = $(noticias[noticiaAtualIndex]);
                proximaNoticia.addClass("active");

                imagemAtualIndex = 0;
                let imagensDaProxima = proximaNoticia.find(
                    ".imagens-noticia img"
                );
                if (imagensDaProxima.length > 0) {
                    imagensDaProxima
                        .eq(imagemAtualIndex)
                        .addClass("active zooming");
                }
                animarEntradaTexto(proximaNoticia);
            });
        } else {
            imagens.eq(imagemAtualIndex).addClass("active zooming");
        }
    }

    function iniciar() {
        let primeiraNoticia = $(noticias[0]);
        primeiraNoticia.addClass("active");

        let imagensDaPrimeira = primeiraNoticia.find(".imagens-noticia img");
        if (imagensDaPrimeira.length > 0) {
            imagensDaPrimeira.eq(0).addClass("active zooming");
        }

        animarEntradaTexto(primeiraNoticia);
        setInterval(proximoSlide, tempoPorImagem);
    }

    iniciar();
});
