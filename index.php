<?php
session_start();
require './views/templates/header.php';
if (!isset($_SESSION['rol'])) {
    $btn1 = $iniciarBtn;
    $btn2 = $registrarBtn;
} else {
    $btn1 = $menuBtn;
    $btn2 = $logoutBtn;
}

require './views/home.php';
require './views/templates/footer.php';
?>