<?php
include '../modello/manageDatabase.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = htmlspecialchars($_POST["email"]);
    $confemail = htmlspecialchars($_POST["confEmail"]);
    if ($email !== $confemail) {
        redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, false, true, false, false);
        die();
    }
    $password = htmlspecialchars($_POST["password"]);
    $confpassword = htmlspecialchars($_POST["confPassword"]);
    if ($password !== $confpassword) {
        redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, false, false, true, false);
    }
    if (strlen($password) < 6) {
        redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, false, false, false, true);
    }
    $nome = htmlspecialchars($_POST["name"]);
    $cognome = htmlspecialchars($_POST["surname"]);
    $sesso = htmlspecialchars($_POST["sesso"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $conn = dbConnect('mysite');
    
    $result = getEmailAvailability($email);
    if ($result == -1) {    //Errore database
        redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, false, false, false, false);
    }else if ($result == 0) {   //MAIL GIA PRESENTE
        redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, true, false, false, false);
    } else {        //PROCEDI
        if (!createAccount($tipo, $nome, $cognome, $email, $password, $sesso)) {    //CREAZIONE FALLITA
            redirect("register.php", $email, $sesso, $tipo, $nome, $cognome, false, false, false, false);
        } else {    //RIUSCITA
            redirect1("login.php", $email, true);
        }
    }
    exit(0);
} else {
    header("Location: register.php");
    die();
}

function redirect($url, $email, $sesso, $tipo, $nome, $cognome, $presente, $emailDiverse, $passwordDiverse, $passwordCorta) {
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <script type="text/javascript">
                function closethisasap() {
                    document.forms["redirectpost"].submit();
                }
            </script>
        </head>
        <body onload="closethisasap();">
            <form name="redirectpost" method="post" action="<? echo $url; ?>">
                <?php
                echo '<input type="hidden" name="email" value="' . $email . '"> ';
                echo '<input type="hidden" name="sesso" value="' . $sesso . '"> ';
                echo '<input type="hidden" name="tipo" value="' . $tipo . '"> ';
                echo '<input type="hidden" name="nome" value="' . $nome . '"> ';
                echo '<input type="hidden" name="cognome" value="' . $cognome . '"> ';
                echo '<input type="hidden" name="presente" value="' . $presente . '"> ';
                echo '<input type="hidden" name="mailDiverse" value="' . $emailDiverse . '"> ';
                echo '<input type="hidden" name="passwordDiverse" value="' . $passwordDiverse . '"> ';
                echo '<input type="hidden" name="passwordCorta" value="' . $passwordCorta . '"> ';
                ?>
            </form>
        </body>
    </html>
    <?php
    exit;
}

function redirect1($url, $email, $success) {
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <script type="text/javascript">
                function closethisasap() {
                    document.forms["redirectpost"].submit();
                }
            </script>
        </head>
        <body onload="closethisasap();">
            <form name="redirectpost" method="post" action="<? echo $url; ?>">
                <?php
                echo '<input type="hidden" name="email" value="' . $email . '"> ';
                echo '<input type="hidden" name="success" value="' . $success . '"> ';
                ?>
            </form>
        </body>
    </html>
    <?php
    exit;
}
?>




?>
