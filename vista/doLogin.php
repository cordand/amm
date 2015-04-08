<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
            <title></title>


    </head>
    <body>

        <?php

        include 'modello/CarrelloClass.php';
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $conn = dbConnect('mysite');
            
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $result = logIn($email, $password);
            
            if (!$result) {
                redirect_post("index.php?comando=login", $email);
            } else {
                $data = mysql_num_rows($result);
                if ($data == 1) {

                    session_start();
                    $data = mysql_fetch_row($result);


                    $_SESSION['username'] = $data[0];
                    $_SESSION['surname'] = $data[1];
                    $_SESSION['tipo'] = $data[3];
                    $_SESSION['email'] = $email;
                    $_SESSION['carrello'] = new CarrelloClass();
                    if (isset($_POST['remember']) && $_POST['remember']) {
                        $token = md5(DATE_ATOM);
                        $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '" . $token . "' WHERE email = '" . $email . "'");


                        setcookie("n", $data[2], time() + 2592000);
                        setcookie("t", $token, time() + 2592000);
                    } else {
                        $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '' WHERE email = '" . $email . "'");

                        setcookie("n");
                        setcookie("t");
                    }
                    mysql_query($sql);

                    header("Location: index.php");
                } else {
                    redirect("index.php?comando=login", $email);
                }
            }

            exit(0);
        } else {
            if (!empty($_POST['email'])) {
                $email = htmlspecialchars($_POST["email"]);
                redirect("index.php?comando=login", $email);
            } else {
                redirect("index.php?comando=login", $email);
            }
            die();
        }

        function redirect($url, $email) {
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
                        echo '<input type="hidden" name="success" value="' . false . '"> ';
                        ?>
                    </form>
                </body>
            </html>
            <?php
            exit;
        }
        ?>
    </body>
</html>
