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

function iniciarSlideshow(tempoPorSlide) {
    let currentSlide = 0;
    const slides = $(".slide");
    const slideInterval = tempoPorSlide || 10000;
    if (slides.length <= 1) {
        if (slides.length === 1) {
            $(slides[0]).addClass("active");
            animarEntradaTexto($(slides[0]));
        }
        return;
    }

    function animarEntradaTexto(slide) {
        const h2 = slide.find("h2");
        const p = slide.find("p");
        if (h2.length > 0) {
            h2.css("left", "-90vw").animate({ left: "2vw" }, 1500);
            p.css("left", "90vw").animate({ left: "2vw" }, 1500);
        }
    }

    function proximoSlide() {
        const slideAtual = $(slides[currentSlide]);
        const h2 = slideAtual.find("h2");
        const p = slideAtual.find("p");

        if (h2.length > 0 && p.length > 0) {
            h2.animate({ left: "90vw" }, 800);
            p.animate({ left: "-90vw" }, 800, function () {
                mudarParaProximo();
            });
        } else {
            mudarParaProximo();
        }
    }

    function mudarParaProximo() {
        $(slides[currentSlide]).removeClass("active");
        currentSlide = (currentSlide + 1) % slides.length;
        const novoSlide = $(slides[currentSlide]);
        novoSlide.addClass("active");
        animarEntradaTexto(novoSlide);
    }

    $(slides[0]).addClass("active");
    animarEntradaTexto($(slides[0]));
    setInterval(proximoSlide, slideInterval);
}

$(document).ready(function () {
    atualizarData();
    window.setInterval(atualizaHora, 1000);
    iniciarSlideshow(10000);
});
