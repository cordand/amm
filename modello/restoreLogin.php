<?php

include_once 'ManageDatabase.php';
include_once 'CarrelloClass.php';
include_once 'template/header.php';
include_once 'template/sidebar.php';
include_once 'ErrorCode.php';
include_once 'UserReg.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




function goSidebar($db) {
    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        printSidebar($db,true, $_SESSION['tipo'], $_SESSION['email']);
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($_COOKIE['n'], $_COOKIE['t'])) {
                printSidebar($db,true, $_SESSION['tipo'], $_SESSION['email']);
            } else {
                printSidebar($db,false, false, 0);
            }
        } else {
            printSidebar($db,false, false, 0);
        }
    }
}

function goHeader() {

    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        printHeader($_SESSION['username'], $_SESSION['surname'], $_SESSION['tipo']);
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($_COOKIE['n'], $_COOKIE['t'])) {
                printHeader($_SESSION['username'], $_SESSION['surname'], $_SESSION['tipo']);
            } else {
                printHeader("", "", 0);
            }
        } else {
            printHeader("", "", 0);
        }
    }
}

function goHeaderLogin() {
    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        header("Location: profile.php");
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($_COOKIE['n'], $_COOKIE['t'])) {
                header("Location: profile.php");
            } else {
                printHeader("", "", 0);
            }
        } else {
            printHeader("", "", 0);
        }
    }
}

function restoreLogin($id, $token) {
    $db= new ManageDatabase("mysite");
    $id = htmlspecialchars($id);
    $token = htmlspecialchars($token);

    $result=$db->restoreLoginDb($id, $token);
    if (!$result) {
        return 0;
    } else {
        $data = mysql_num_rows($result);
        if ($data == 1) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $data = mysql_fetch_row($result);
            $_SESSION['username'] = $data[0];
            $_SESSION['surname'] = $data[1];
            $_SESSION['email'] = $data[2];
            $_SESSION['tipo'] = $data[3];
            $_SESSION['carrello'] = new CarrelloClass();
            $db->updateToken($data[2]);

            return 1;
        } else {
            return 0;
        }
    }
}
