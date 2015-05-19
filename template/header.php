<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printHeader($nome, $cognome, $tipo) {

    if (strlen($nome) > 0 && strlen($cognome) > 0) {
        echo '<div id="topBar">'; //eventuali modifiche
    } else {
        echo '<div id="topBar">';
    }
    echo '
        
             
                <nav>
                    <ul>

                            <li><a href="#"></a>
                                    <ul>
                                            <li class="primo"><a href="index.php?comando=paginainiziale">Home</a></li>';
    if (strlen($nome) > 0 && strlen($cognome) > 0) {
        echo '<li class="centrale"><a href="index.php?comando=profilo">' . $nome . ' ' . $cognome . '</a></li>';
        if ($tipo) {
            echo '<li class="centrale"><a href="index.php?comando=aggiungiItem">Aggiungi</a></li>';
        } else {
            //echo '<li><a href="index.php?comando=carrello">Carrello</a></li>';
        }
        echo '<li class="ultimo"><a href="index.php?comando=logout">Logout</a></li>';
    } else {
        echo '<li class="ultimo"><a href="index.php?comando=login">Login</a></li>';
    }
    echo '                                    
                                    </ul>
                            </li>
                            
                    </ul>
   </nav>
            </form>
             
         </div>
            <header id="header">
        ';
    echo '<div class="immagineHeader">
            <a href="index.php?comando=paginainiziale"><img title="Home" src="images/header.png"/></a>
            
            <form id="searchbox" accept-charset="UTF-8" action="index.php?comando=cerca" class="search" method="post" role="search">
            

            <input id="query" name="query" placeholder="Cerca" type="text">
            <input id="submit" name="button" type="submit" value="Cerca"></form>
        </div>';
    if (strlen($nome) > 0 && strlen($cognome) > 0) {
        if ($tipo) {
            echo '<ul class="navbar loggedin commerciante">';
        } else {
            echo '<ul class="navbar loggedin">';
        }
    } else {
        echo '<ul class="navbar">';
    }
    echo '
        <li class="primo"><a href="index.php?comando=paginainiziale">Home</a></li>
        ';
    if (strlen($nome) > 0 && strlen($cognome) > 0) {
        echo '<li class="centrale"><a href="index.php?comando=profilo">' . $nome . ' ' . $cognome . '</a></li>';
        if ($tipo) {
            echo '<li class="centrale"><a href="index.php?comando=aggiungiItem">Aggiungi</a></li>';
        } else {
            //echo '<li><a href="index.php?comando=carrello">Carrello</a></li>';
        }
        echo '<li class="ultimo"><a href="index.php?comando=logout">Logout</a></li>';
    } else {
        echo '<li class="ultimo"><a href="index.php?comando=login">Login</a></li>';
    }
    echo'
      </ul>
    </header>';
}

?>
