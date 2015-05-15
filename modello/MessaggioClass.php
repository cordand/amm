<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MessaggioClass{
    var $idMittente,$idDestinatario,$idMessaggio,$idProdotto,$nomeD,$nomeP,$nomeM,$testo,$letto,$data;
    function __construct() {
        
    }
    function getNomeD() {
        return $this->nomeD;
    }

    function getNomeP() {
        return $this->nomeP;
    }

    function getNomeM() {
        return $this->nomeM;
    }

    function getTesto() {
        return $this->testo;
    }

    function getLetto() {
        return $this->letto;
    }

    function setNomeD($nomeD) {
        $this->nomeD = $nomeD;
    }

    function setNomeP($nomeP) {
        $this->nomeP = $nomeP;
    }

    function setNomeM($nomeM) {
        $this->nomeM = $nomeM;
    }

    function setTesto($testo) {
        $this->testo = $testo;
    }

    function setLetto($letto) {
        $this->letto = $letto;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getIdMessaggio() {
        return $this->idMessaggio;
    }

    function setIdMessaggio($idMessaggio) {
        $this->idMessaggio = $idMessaggio;
    }

    function getIdDestinatario() {
        return $this->idDestinatario;
    }

    function setIdDestinatario($idDestinatario) {
        $this->idDestinatario = $idDestinatario;
    }

    function getIdProdotto() {
        return $this->idProdotto;
    }

    function setIdProdotto($idProdotto) {
        $this->idProdotto = $idProdotto;
    }
    function getIdMittente() {
        return $this->idMittente;
    }

    function setIdMittente($idMittente) {
        $this->idMittente = $idMittente;
    }



    
}
