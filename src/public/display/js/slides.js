function slide({ repeat, tempo, next }) {
    repeat = repeat || 1;
    tempo = tempo || 5000;
    next = next || "index.html";

    $("#painel").css("display", "none");
    $("#painel").fadeIn(2000);

    $(".noticia > h2,p").animate({ left: "2vw" }, 1500);

    var qtd = $(".noticia > img").size();

    var cont = 0;
    var slide = setInterval(function () {
        var $firstSlide = $(".noticia").find("img:first");
        $firstSlide.animate({ opacity: 0 }, 1000, function () {
            var $lastSlide = $(".noticia").find("img:last");
            $lastSlide.after($firstSlide);
            $firstSlide.animate({ opacity: 1 }, 1000);
        });
        cont++;
        if (cont > (qtd - 1) * repeat) clearInterval(slide);
    }, tempo);

    setTimeout(function () {
        $(".noticia > p").animate({ left: "-90vw" }, 1500);
        $(".noticia > h2").animate({ left: "90vw" }, 1500, function () {
            $("#painel").css("width", "100vh");
            $("#painel").animate(
                {
                    borderBottomRightRadius: "100%",
                    borderBottomLeftRadius: "100%",
                    borderTopRightRadius: "100%",
                    borderTopLeftRadius: "100%",
                    width: 0,
                    height: 0,
                },
                1000,
                function () {
                    location = next;
                }
            );
        });
    }, qtd * repeat * tempo);
}

var arrayMes = new Array(12);
arrayMes[0] = "JAN";
arrayMes[1] = "FEV";
arrayMes[2] = "MAR";
arrayMes[3] = "ABR";
arrayMes[4] = "MAI";
arrayMes[5] = "JUN";
arrayMes[6] = "JUL";
arrayMes[7] = "AGO";
arrayMes[8] = "SET";
arrayMes[9] = "OUT";
arrayMes[10] = "NOV";
arrayMes[11] = "DEZ";

function atualizarData() {
    var dataAtual = new Date();
    var dia = dataAtual.getDay();
    var mes = arrayMes[dataAtual.getMonth()];
    var ano = dataAtual.getFullYear();
    document.getElementById("dia").innerHTML = dia;
    document.getElementById("mes").innerHTML = mes;
    document.getElementById("ano").innerHTML = ano;
}

function atualizaHora() {
    var d = new Date(),
        displayDate;
    if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
        displayDate = d.toLocaleTimeString("pt-BR");
    } else {
        displayDate = d.toLocaleTimeString("pt-BR", {
            timeZone: "America/Belem",
        });
    }
    document.getElementById("hora").innerHTML =
        "<i class='feather icon-clock m-l-5'></i> " + displayDate;
}
