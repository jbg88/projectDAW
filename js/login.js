
//creo una función para solo permitir el submit si todos los datos son correctos
function validate2() {
    // creo variable para permitir el submit o no
    var letSubmit = true;

//primero compruebo que el userName sea correcto, de no serlo pongo la variable letSubmit a false
    var nick = document.getElementById("nick").value;
    var exp_regName  = /^[a-zA-Z]+[a-zA-Z\d_]{1,18}$/i; //expresion regular para solo letras y numeros con minimo 1 y maximo 18, minimo una letra al principio
    var verify = exp_regName.test(nick);

    if(verify != true){
        letSubmit = false;
        alert("EL nombre debe comenzar con una letra y no ser superior a 18 caracteres");
    }


    //ahora comprobamos las contrasenyas para que sean correctas e iguales
    var pass = document.getElementById("passLog").value;
    //contraseña con almenos una mayuscula, una minuscula, un numero o caracter especial con minimo 8 caracteres y maximo 18
    var exp_regPass = /(?=^.{8,18}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    var verify2 = exp_regPass.test(pass);

    if(verify2 != true){
        letSubmit = false;
        alert("La contraseña debe contener una mayúscula, una minúscula, un número o caracter especial y estar entre 8 y 18 caracteres.");
    }

    return letSubmit;
}

