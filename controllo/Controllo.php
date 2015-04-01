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
    }
    
    
}
