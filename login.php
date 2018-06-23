<?php
//si ya se ha iniciado session redirige al home
if (!empty($_SESSION['user'])) {
    header('Location: index.php?p=home');
    exit;
}
//si se han enviado datos, los compruebo, creando su correspondiente array de errores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nick'])) {
        $errors[] = "The nickname is empty";
    }
    if (empty($_POST['passLog'])) {
        $errors[] = "The password is empty";
    }
    //si no hay errores, intento crear el array de user de session
    if (empty($errors)) {
        $nickname = $_POST['nick'];
        $password = $_POST['passLog'];
        $query = "SELECT nick, age, email, rol, password FROM users WHERE nick = ?";
        $prepared = $db->prepare($query);
        $prepared->bind_param('s', $nickname);
        $prepared->execute();
        $prepared->bind_result($nick, $age, $email, $rol, $pass);
        $prepared->store_result();//guardo el resultado para que no se quede un fetch abierto si luego abro otro,
        //evito problemas al hacer varias operaciones en la misma conexión
        if ($prepared->fetch() && password_verify($password, $pass)) {//si todo está bien, creo el array
            $_SESSION['user'] = [
                'nick' => $nick,
                'age' => $age,
                'email' => $email,
                'rol' => $rol
            ];
            header('Location: index.php?p=home');
            exit;
        } else {//si algo falla aviso de ello
            $errors[] = "Failed to log you in";
        }
    }
}
?>

<form action="index.php?p=login" method="post" name="formLog" onsubmit='return validate2()' id="formLog">
    <!--    si hay errores los muestro-->
    <?= !empty($errors) ? "<p class='errorLog'>" . implode('<br>', $errors) . "</p>" : '' ?>
    <h1 id="logTitle">Log In Form</h1>

    <div class="divLog">
        <span class="spanLog"><label for="nick">User name or nick: </label></span>
        <span class="spanLog"><input type="text" id="nick" name="nick" required maxlength="18" minlength="2"/></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="passLog">Password: </label></span>
        <span class="spanLog"><input type="password" id="passLog" name="passLog" required maxlength="18" minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><input type="submit" value="Log In" name="logData" id="logData"></span>
    </div>

</form>