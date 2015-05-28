<?php


include_once 'ManageDatabase.php';
include_once 'CarrelloClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/template/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/template/sidebar.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/template/footer.php';
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
            if (restoreLogin($db,$_COOKIE['n'], $_COOKIE['t'])) {
                printSidebar($db,true, $_SESSION['tipo'], $_SESSION['email']);
            } else {
                printSidebar($db,false, false, 0);
            }
        } else {
            printSidebar($db,false, false, 0);
        }
    }
}

function goHeader($db) {

    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        printHeader($_SESSION['username'], $_SESSION['surname'], $_SESSION['tipo']);
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($db,$_COOKIE['n'], $_COOKIE['t'])) {
                printHeader($_SESSION['username'], $_SESSION['surname'], $_SESSION['tipo']);
            } else {
                printHeader("", "", 0);
            }
        } else {
            printHeader("", "", 0);
        }
    }
}

function goHeaderLogin($db) {
    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        header("Location: profile.php");
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($db,$_COOKIE['n'], $_COOKIE['t'])) {
                header("Location: profile.php");
            } else {
                printHeader("", "", 0);
            }
        } else {
            printHeader("", "", 0);
        }
    }
}

function restoreLogin($db,$id, $token) {
    $id = htmlspecialchars($id);
    $token = htmlspecialchars($token);

    $result=$db->restoreLoginDb($id, $token);
    if (!$result) {
        return 0;
    } else {
        
            $data = $result;
            $_SESSION['username'] = $data[0];
            $_SESSION['surname'] = $data[1];
            $_SESSION['email'] = $data[2];
            $_SESSION['tipo'] = $data[3];
            $_SESSION['id'] = $data[4];
            $_SESSION['carrello'] = new CarrelloClass();
            $db->updateToken($data[4],$data[2],$token,$data[5]);

            return 1;
        
    }
}
