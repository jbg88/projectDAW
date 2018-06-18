var process;
$(document).ready(function () {
    var actualIndex = 0;
    var images = $('.slide div');//guardo en una matriz los divs que tengo dentro del slide
    var numObjetos = images.length;//guardo cuantas imagenes tengo

    /*creo una función llamada changeImage,
    lo que hace es, de la variable images obtengo la posición de la imagen a
    mostrar por medio de la función de jQuery .eq() pasandole como parámetro la variable
    actualIndex y lo guardo en la variable image, oculto todos los objetos y finalmente
    pongo visible solo la que tiene la variable imagen con display:inline-block.*/
    function changeImage() {
        var image = images.eq(actualIndex);//le paso a la funcion
        images.hide();
        image.css('display', 'inline-block');
    }

    /*Para asegurarnos de que nuestras imágenes giran de forma automática,
    es necesario llamar continuamente nuestra función changeImage después de una cierta cantidad de tiempo.
    Hacemos esto mediante la creación de otra variable llamada process,
    esta variable almacena una función setInterval, que tiene un retardo de 3000 milisegundos o tres segundos.
    Dentro de esa función, incrementamos la variable actualIndex en uno,
    por lo que images.eq(actualIndex); siempre hará referencia al siguiente contenedor div.
    En caso de mover manualmente las imagenes se cancelara esta funcion automatica.*/
    process = setInterval(function () {
        actualIndex += 1;
        //si me paso de la cantidad total de imagenes vuelvo a 0 el actualIndex y llamo a changeImage()
        //para evitar pasarme de images y provocar error
        if (actualIndex > (numObjetos - 1)) {
            actualIndex = 0;
        }
        changeImage();
    }, 3000);

    //botones de movimiento manual de las imagenes
    $('.next').click(function () {
        cleanInterval();
        actualIndex += 1;
        //si me paso de la cantidad total de imagenes vuelvo a 0 el actualIndex y llamo a changeImage()
        //para evitar pasarme de images y provocar error
        if (actualIndex > (numObjetos - 1)) {
            actualIndex = 0;
        }
        changeImage();
    });
    $('.previous').click(function () {
        cleanInterval();
        actualIndex -= 1;
        //en caso de ir para atrás y estar en la primera, establezco el actualIndex al total de imagenes -1
        //para colocarme en la ultima
        if (actualIndex < 0) {
            actualIndex = numObjetos - 1;
        }
        changeImage();
    });
});

function cleanInterval() {
    window.clearInterval(process);
}