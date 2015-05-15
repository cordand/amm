<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'template/header.php';
        include 'template/sidebar.php';
        include 'modello/restoreLogin.php';
        session_start();
        if(!isset($_POST['id'])){
            header("Location: index.php");
            die();
        }
        $db = new ManageDatabase("mysite");
        $db->removeItem($_POST['id'], $_SESSION['id']);
        $db->close();
        header("Location: index.php");
         
        
        ?>
    </body>
</html>
