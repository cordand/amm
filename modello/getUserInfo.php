<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'manageDatabase.php';

session_start();

/**
 * Controlla che un utente sia loggato
 * @param type $db
 * @return boolean
 */

function isLoggedIn($db) {
    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        return true;
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($db,$_COOKIE['n'], $_COOKIE['t'])) {
               //loggato
                return true;
            } else {
                return false;
            }
        } else {
             return false;
        }
    }
}





/**
 * Restituisce in una taballa i dettagli dell'utente
 */

if(isLoggedIn($db)){
    $data=userDetails($_SESSION['email']);
    if($data!=null){
        ?>
        <table>
            <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
            <th>Tipo account</th>
            </tr>    
        <?php
        echo "<tr>";
    echo "<td>" . $data[0] . "</td>";
    echo "<td>" . $data[1]  . "</td>";
    echo "<td>" .$data[2]  . "</td>";
    echo "<td>" . $data[3]==1?"Venditore" : "Compratore"  . "</td>";
    echo "</tr>";
    }
}else{
    
    ?>
    Non sei loggato
    <?php
}
