<?php


/**
 * Description of Controllo
 *
 * @author Andrea Corda
 */
include 'modello/ManageDatabase.php';

class Controllo {
    
    
    

    
    
    public function invoke()
    {
      // leggo il comando, per default "paginainiziale"
      $comando = isset($_REQUEST["comando"])?$_REQUEST["comando"] : "paginainiziale";
      if ($comando == "paginainiziale")
      {
         
         include("vista/index.php"); //Carico l'homepage
      }else if($comando == "view"){
          include("vista/viewer.php"); //Carico i dettagli prodotto
      }
      else if($comando == "logout"){
          include("vista/logout.php"); //Carico il logout
      }
      else if($comando == "login"){
          include("vista/login.php"); //Carico pagina login
      }
      else if($comando == "doLogin"){
          include("vista/doLogin.php"); //Carico script esecuzione login
      }
      
      else if($comando == "register"){  //Carico pagina registrazione
          include("vista/register.php");
      }
      else if($comando == "doRegister"){    //Carico script registrazione
          include("vista/doRegister.php");
      }
      else if($comando == "aggiungiItem"){  //Carico pagina inserimento elemento
          include("vista/addItem.php");
      }
      else if($comando == "profilo"){   //Carico pagina profilo
          include("vista/profile.php");
      }
      else if($comando == "cerca"){ //Carica la pagina iniziale
          include("vista/index.php");
      }
      else if($comando == "contatta"){  //Carico la pagina per contattare
          include("vista/contatta.php");
      }
      else if($comando == "leggi"){ //Carico i dettagli messaggio
          include("vista/leggi.php");
      }
      else if($comando == "rimuovi"){   //Carico lo script che rimuove un elemento
          include("vista/remove.php");
      }
    }
    
    
}
