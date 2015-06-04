<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Oggetto utilizzato per la registrazione di un utente, contiene tutti i dettagli
 */

class UserReg{
    private $email,$nome,$cognome,$sesso,$tipo,$citta,$via;
    
    function __construct($email, $nome, $cognome,$citta,$via, $sesso, $tipo) {
        $this->email = $email;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->sesso = $sesso;
        $this->tipo = $tipo;
        $this->citta = $citta;
        $this->via = $via;
    }

    function getCitta() {
        return $this->citta;
    }
    function getVia() {
        return $this->via;
    }
    function getEmail() {
        return $this->email;
    }

    function getNome() {
        return $this->nome;
    }

    function getCognome() {
        return $this->cognome;
    }

    function getSesso() {
        return $this->sesso;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCognome($cognome) {
        $this->cognome = $cognome;
    }

    function setSesso($sesso) {
        $this->sesso = $sesso;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    
}

