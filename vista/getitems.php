
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 include  $_SERVER['DOCUMENT_ROOT'].'/modello/restoreLogin.php';
 include $_SERVER['DOCUMENT_ROOT'].'/modello/ElementiHome.php';
 $db = new ManageDatabase("mysite");
 $el = new ElementiHome($db);
 echo $el->getElementi($_GET['ultimo'],$_GET['query']);
 $db->close();
 
 ?>
   