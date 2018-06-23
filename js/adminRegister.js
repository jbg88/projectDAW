
//creo una función para solo permitir el submit si todos los datos son correctos
function validate3() {
    // creo variable para permitir el submit o no
    var letSubmit = true;

//primero compruebo que el userName sea correcto, de no serlo pongo la variable letSubmit a false
    var userName = document.getElementById("userName").value;
    var exp_regName  = /^+[a-zA-Z][a-zA-Z\d_]{1,18}$/i; //expresion regular para solo letras y numeros con minimo 1 y maximo 18, minimo una letra al principio
    var verify = exp_regName.test(userName);

    if(verify != true){
        letSubmit = false;
        alert("EL nombre debe comenzar con una letra y no ser superior a 18 caracteres");
    }

    //ahora compruebo la edad, aunque debería bastar con los atributos html
    var age = document.getElementById("age").value;
    var exp_regAge = /[0-9]{1,3}/;
    var verify2 =  exp_regAge.test(age);

    if(verify2 != true || age>150 || age<0){
        letSubmit = false;
        alert("La edad debe contener como máximo 3 caracteres y no ser mayor de 150 o menor de 0")
    }

    //ahora comprobamos las contrasenyas para que sean correctas e iguales
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    //contraseña con almenos una mayuscula, una minuscula, un numero o caracter especial con minimo 8 caracteres y maximo 18
    var exp_regPass = /(?=^.{8,18}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    var verify3 = exp_regPass.test(pass1);

    if(verify3 != true){
        letSubmit = false;
        alert("La contraseña debe contener una mayúscula, una minúscula, un número o caracter especial y estar entre 8 y 18 caracteres.");
    }else if(pass1 !== pass2){
        letSubmit = false;
        alert("Passwords must be equals.");
    }

    //po último comprobamos el email
    var email = document.getElementById("email").value;
    var exp_regMail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;//expresion regular para el correo
    var verify4 = exp_regMail.test(email);

    if(verify4 != true){
        letSubmit = false;
        alert("Please introduce a correct e-mail form(test@test.com)");
    }

    return letSubmit;
}

