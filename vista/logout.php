<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
unset($_SESSION['username']);
unset($_SESSION['surname']);
unset($_SESSION['email']);
setcookie("n");
setcookie("t");
session_destroy();
header("Location: index.php");
?>

