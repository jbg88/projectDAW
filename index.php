<?php
require("header.php")
?>

<?php
$option = "home";
if (isset($_GET['p'])) {
    $option = $_GET['p'];
}
require($option . ".php")
?>

<?php
require("footer.php")
?>