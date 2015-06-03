<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'ItemClass.php';
class CarrelloClass{
    var $numeroElementi=0;
    var $elementi=array();
    function __construct(){
       
    }
    function aggiungiElemento($nome,$id,$prezzo,$quantita){
        if(isset($temp))
            unset ($temp);
        $temp = new ItemClass($id,$nome,$prezzo,$quantita);  
        $trovato=false;
        foreach($this->elementi as &$temp1){
            if($temp1->getId()==$id){
                $temp1->aggiungi($quantita);
                $trovato=true;
                break;
            }
        }
        if (!$trovato) {
            array_push($this->elementi, $temp);
        }
    }
    function rimuoviElemento($id){
        foreach($this->elementi as $i => &$temp){
            if($temp->getId()==$id){
                if($temp->getQuantita()==1){
                    unset($this->elementi[$i]);
                    $this->elementi = array_values($this->elementi);
                    
                }else{
                    $temp->togliUno();
                }
            }
        }
    }
    function getElementi(){
        return $this->elementi;
    }
    
    
}
