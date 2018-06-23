<?php

//si se han enviado datos, los compruebo, creando su correspondiente array de errores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    if (empty($_POST['userName'])) {
        $errors[] = "User is empty.";
    }
    if (empty($_POST['age'])) {
        $errors[] = "Age is empty";
    }
    if (empty($_POST['pass1'])) {
        $errors[] = "Password is empty";
    } else if (empty($_POST['pass2'])) {
        $errors[] = "Confirm password is empty";
    } else if ($_POST['pass1'] !== $_POST['pass2']) {
        $errors[] = "Password do not match";
    }
    if (empty($_POST['email'])) {
        $errors[] = "E-mail is empty";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
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
        if ($total > 0) {//si existe el usuario, lo modifico
            $age = $_POST['age'];
            $pass1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $role = $_POST['adminSel'];
            $query = "UPDATE users SET  age=?, password=?, email=?, rol=? WHERE nick=?";
            $prepared = $db->prepare($query);
            $prepared->bind_param('issss', $age, $pass1, $email, $role, $userName);
            $prepared->execute();
            $done[] = $userName . " was modified";
        } else {//si no existe aviso
            $errors[] = "User not exists";
        }
    }
}
?>

<form action="index.php?p=adminmodify" method="post" name="formModiAdmin" onsubmit='return validate()'
      id="formModiAdmin">
    <!--    si hay errores los muestro-->
    <?= !empty($errors) ? "<p class='errorReg'>" . implode('<br>', $errors) . "</p>" : '' ?>
    <?= !empty($done) ? "<p class='errorReg'>" . implode('<br>', $done) . "</p>" : '' ?>
    <h1 id="adminModifyTitle">Admin Modify Form</h1>

    <div class="divLogA">
        <span class="spanLog"><label for="userName">User name or nick: </label></span>
        <span class="spanLog"><input type="text" id="userName" name="userName" required maxlength="18"
                                     minlength="1"/></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="age">Age: </label></span>
        <span class="spanLog"><input type="number" id="age" name="age" required maxlength="3" min="0" max="150"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="pass1">Password: </label></span>
        <span class="spanLog"><input type="password" id="pass1" name="pass1" required maxlength="18"
                                     minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="pass2">Confirm password: </label></span>
        <span class="spanLog"><input type="password" id="pass2" name="pass2" required maxlength="18"
                                     minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="email">E-mail: </label></span>
        <span class="spanLog"><input type="email" id="email" name="email" required placeholder="test@test.com"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="adminSel">User rol: </label></span>
        <span class="spanLog">
            <select id="adminSel" name="adminSel" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
        </span>
    </div>

    <div class="divLog">
        <span class="spanLog"><input type="submit" value="Submit" name="submitData" id="submitData"></span>
    </div>

</form>