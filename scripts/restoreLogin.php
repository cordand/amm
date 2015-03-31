<?php

include_once 'manageDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function goSidebar() {
    if (isset($_SESSION['username']) && isset($_SESSION['surname'])) {

        printSidebar(true, $_SESSION['tipo'], 0);
    } else {
        if (isset($_COOKIE['n']) && isset($_COOKIE['t'])) {
            if (restoreLogin($_COOKIE['n'], $_COOKIE['t'])) {
                printSidebar(true, $_SESSION['tipo'], 0);
            } else {
                printSidebar(false, false, 0);
            }
        } else {
            printSidebar(false, false, 0);
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
    $conn = dbConnect('mysite');
    $id = htmlspecialchars($id);
    $token = htmlspecialchars($token);

    $sql = "SELECT nome,cognome,email,tipo FROM users WHERE numero = '" . $id . "' AND remember='" . $token . "'";
    $result = mysql_query($sql);
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
            $token = md5(DATE_ATOM);
            $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '" . $token . "' WHERE email = '" . $data[2] . "'");
            setcookie("n", $id, time() + 2592000);
            setcookie("t", $token, time() + 2592000);
            mysql_query($sql);

            return 1;
        } else {
            return 0;
        }
    }
}
