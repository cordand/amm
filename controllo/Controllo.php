<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controllo
 *
 * @author amm
 */
include 'modello/manageDatabase.php';
class Controllo {
    //put your code here
    
    

    
    
    public function invoke()
    {
      // leggo il comando, per default "paginainiziale"
      $comando = isset($_REQUEST["comando"])?$_REQUEST["comando"] : "paginainiziale";
      if ($comando == "paginainiziale")
      {
         // passo il controllo alla vista "paginainziale.php"
         include("vista/index.php");
      }else if($comando == "view"){
          include("vista/viewer.php");
      }
      else if($comando == "logout"){
          include("vista/logout.php");
      }
      else if($comando == "login"){
          include("vista/login.php");
      }
      else if($comando == "doLogin"){
          include("vista/doLogin.php");
      }
      else if($comando == "carrello"){
          include("vista/carrello.php");
      }
      else if($comando == "register"){
          include("vista/register.php");
      }
      else if($comando == "doRegister"){
          include("vista/doRegister.php");
      }
      else if($comando == "aggiungiItem"){
          include("vista/addItem.php");
      }
      else if($comando == "profilo"){
          include("vista/profile.php");
      }
    }
    
    
}
