<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ElementiHome{
    var $database;
    function __construct($db) {
        $this->database=$db;

        
        
    }
    
    function getElementi($indice,$query){
        
       $ret="";
        $result=  $this->database->getIndexItems($indice,$query);
        if(!$result)
            return "";

               while($data = $result->fetch_row()){
                    
                    $ret.='<li class="flex-item">';
                    $ret.='<h3 class="nomeArticolo" ><a href="index.php?comando=view&amp;id='.$data[0].'">';
                    $ret.=$data[1];
                    $ret.='</a></h3>';
                    $ret.='<a href="index.php?comando=view&amp;id='.$data[0].'">';
                    $ret.='<img class="flex-image" src="'.$data[3].'" onerror="this.src=\'images/error.png\'" alt="immagine">';
                    $ret.='</a>';
                    
                    $ret.='<p class="prezzo">';
                    $ret.=$data[4].'&euro;';
                    $ret.='</p>';

                    $ret.="</li>\n";
                    

                    
                }
        return $ret;
    }

}