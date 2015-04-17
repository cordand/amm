<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemClass{
    var $id,$nome,$prezzo,$quantita,$descrizione;
    function __construct($id,$nome,$prezzo,$quantita) {
       $this->id=$id;
       $this->nome=$nome;
       $this->prezzo=$prezzo;
       $this->quantita=$quantita;
       
   }
   function conDescrizione($id,$nome,$prezzo,$quantita,$descrizione){
       $instance = new  self($id,$nome,$prezzo,$quantita);
    	$instance->descrizione= $descrizione;
    	return $instance;
   }
   function aggiungi($quantita){
       $this->quantita+=$quantita;
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



