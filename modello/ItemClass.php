<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemClass{
    var $id,$nome,$prezzo,$quantita;
    function __construct($id,$nome,$prezzo,$quantita) {
       $this->id=$id;
       $this->nome=$nome;
       $this->prezzo=$prezzo;
       $this->quantita=$quantita;
       
   }
   function aggiungiUno(){
       $this->quantita++;
   }
   function togliUno(){
       $this->quantita--;
   }
   function getId(){
       return  $this->id;
   }
   function getNome() {
    return $this->nome;
}

 function getPrezzo() {
    return $this->prezzo;
}

 function getQuantita() {
    return $this->quantita;
}
   
}



