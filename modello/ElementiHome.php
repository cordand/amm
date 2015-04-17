<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ElementiHome{
    var $database,$arrayItems,$ret;
    function __construct($db) {
        $this->database=$db;
        $this->ret="";
        
        $result=  $this->database->getIndexItems();
        $num = mysql_num_rows($result);
               
                for ($i = 0; $i < $num; $i++) {
                    
                    $data = mysql_fetch_row($result);
                    $this->ret.='<div class="flex-item">';
                   
                    $this->ret.='<a href="index.php?comando=view&id='.$data[0].'">';
                    $this->ret.='<img class="flex-image" src="'.$data[3].'" onerror="this.src=\'images/error.png\'">';
                    $this->ret.='</a>';
                    $this->ret.='<a href="index.php?comando=view&id='.$data[0].'">';
                    $this->ret.='<span>';
                    $this->ret.='<div class="box">';
                    $this->ret.='<div class="text">';
                    $this->ret.=$data[1];
                    $this->ret.=' </div>';
                    $this->ret.='</div>';
                    $this->ret.='</span>';
                    $this->ret.='</a>';
                    $this->ret.='<p class="prezzo">';
                    $this->ret.=$data[4].'&euro;';
                    $this->ret.='</p>';

                    $this->ret.='</div>';
                    

                    
                }
        
    }
    
    function getElementi(){
       
        return $this->ret;
    }

}