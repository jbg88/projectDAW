<?php
//cierro la sesión y redirigo a la pagin de inicio de sesión
unset($_SESSION['user']);
header('Location: index.php?p=login');
exit;