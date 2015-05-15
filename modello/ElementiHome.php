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
                    
                    $ret.='<div class="flex-item">';
                   
                    $ret.='<a href="index.php?comando=view&id='.$data[0].'">';
                    $ret.='<img class="flex-image" src="'.$data[3].'" onerror="this.src=\'images/error.png\'">';
                    $ret.='</a>';
                    $ret.='<a href="index.php?comando=view&id='.$data[0].'">';
                    $ret.='<span>';
                    $ret.='<div class="box">';
                    $ret.='<div class="text">';
                    $ret.=$data[1];
                    $ret.=' </div>';
                    $ret.='</div>';
                    $ret.='</span>';
                    $ret.='</a>';
                    $ret.='<p class="prezzo">';
                    $ret.=$data[4].'&euro;';
                    $ret.='</p>';

                    $ret.='</div>';
                    

                    
                }
        return $ret;
    }

}