<?php
//funcion para refrescar el array user de session,
// por si se producen cambios en la base de datos mientras la web está en marcha
function refreshSession()
{
    global $db;
    if (!empty($_SESSION['user'])) {
        $query = "SELECT nick, age, email, rol FROM users WHERE nick = ?";
        $prepared = $db->prepare($query);
        $prepared->bind_param('s', $_SESSION['user']['nick']);
        $prepared->execute();
        $prepared->bind_result($nick, $age, $email, $rol);
        if ($prepared->fetch()) {
            $_SESSION['user'] = [
                'nick' => $nick,
                'age' => $age,
                'email' => $email,
                'rol' => $rol
            ];
        } else {
            unset($_SESSION['user']);
        }
    }
}
//inicio la session
session_start();
//conexion a la base de datos
$db = new mysqli('localhost', 'root', '', 'learntoplay');//id6222304_learntoplay
refreshSession();//refresco la sesion
require("header.php");
$option = "home";
if (isset($_GET['p'])) {
    $option = $_GET['p'];
}
require($option . ".php");
$db->close();
require("footer.php");