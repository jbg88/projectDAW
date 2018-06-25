<?php
//si se han enviado datos, los compruebo, creando su correspondiente array de errores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    if (empty($_POST['userName'])) {
        $errors[] = "User is empty.";
    }

    //si no hay errores, compruebo si existe el usuario
    if (empty($errors)) {
        $userName = $_POST['userName'];
        $query = "SELECT COUNT(*) FROM users WHERE nick = ?";
        $prepared = $db->prepare($query);
        $prepared->bind_param('s', $userName);
        $prepared->execute();
        $prepared->bind_result($total);
        $prepared->store_result();//guardo el resultado para que no se quede un fetch abierto si luego abro otro,
        //evito problemas al hacer varias operaciones en la misma conexión
        $prepared->fetch();
        if ($total > 0) {//si existe el usuario, lo borro
            $query = "DELETE FROM users where nick=?";
            $prepared = $db->prepare($query);
            $prepared->bind_param('s', $userName);
            $prepared->execute();
            $done[] = $userName . " was deleted";
        } else {//si no existe aviso
            $errors[] = "User not exists";
        }
    }
}
?>

<form action="index.php?p=admindisreg" method="post" name="formDisregAdmin" onsubmit='return validate()'
      id="formDisregAdmin">
    <!--    si hay errores los muestro-->
    <?= !empty($errors) ? "<p class='errorReg'>" . implode('<br>', $errors) . "</p>" : '' ?>
    <?= !empty($done) ? "<p class='errorReg'>" . implode('<br>', $done) . "</p>" : '' ?>
    <h1 id="adminDisregTitle">Admin Disregister Form</h1>

    <div class="divLogA">
        <span class="spanLog"><label for="userName">User name or nick: </label></span>
        <span class="spanLog"><input type="text" id="userName" name="userName" required maxlength="18"
                                     minlength="1"/></span>
    </div>


    <div class="divLog">
        <span class="spanLog"><input type="submit" value="Submit" name="submitData" id="submitData"></span>
    </div>

</form>