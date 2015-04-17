<?php
include_once 'modello/ManageDatabase.php';
include_once 'modello/ErrorCode.php';
include_once 'modello/UserReg.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = htmlspecialchars($_POST["email"]);
    $confemail = htmlspecialchars($_POST["confEmail"]);
    $nome = htmlspecialchars($_POST["name"]);
    $cognome = htmlspecialchars($_POST["surname"]);
    $sesso = htmlspecialchars($_POST["sesso"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $conn = dbConnect('mysite');
    $via = htmlspecialchars($_POST["via"]);
    $citta = htmlspecialchars($_POST["citta"]);
    $value=new UserReg($email, $nome, $cognome,$citta,$via, $sesso, $tipo);
    if ($email !== $confemail) {
        redirect("index.php?comando=register", $value, ErrorCode::EMAILDIVERSE);
    }
    
    $password = htmlspecialchars($_POST["password"]);
    $confpassword = htmlspecialchars($_POST["confPassword"]);
    if ($password !== $confpassword) {
        
        redirect("index.php?comando=register", $value, ErrorCode::PASSWORDDIVERSE);
    }
    if (strlen($password) < 6) {
        
        redirect("index.php?comando=register", $value, ErrorCode::PASSWORDCORTA);
    }
    
    $result = getEmailAvailability($email);
    
    
    
    if ($result == -1) {    //Errore database
        redirect("index.php?comando=register", $value, ErrorCode::ERROREDATABASE);
    }else if ($result == 0) {   //MAIL GIA PRESENTE
        redirect("index.php?comando=register", $value, ErrorCode::EMAILPRESENTE);
    } else {        //PROCEDI
        $db = new ManageDatabase("mysite");
        if (!$db->createAccount($value, $password)) {    //CREAZIONE FALLITA
            redirect("index.php?comando=register",$value, ErrorCode::ERROREGENERICO);
        } else {    //RIUSCITA
            redirect1("index.php?comando=login", $email, true);
        }
    }
    exit(0);
} else {
    header("Location: index.php?comando=register");
    die();
}

function redirect($url, $value, $errorCode) {
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
            <form name="redirectpost" method="post" action="index.php?comando=register">
                <?php
                session_start();
                $_SESSION['userReg']=$value;
                echo '<input type="hidden" name="errorcode" value="' . $errorCode . '"> ';
               
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
