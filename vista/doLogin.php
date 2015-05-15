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
             $db = new ManageDatabase("mysite");
            
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $result = $db->logIn($email, $password);
//            var_dump($result);
//            die();
            if (!$result) {
                $db->close();
                redirect("index.php?comando=login", $email);
            } else {
                $data = ($result);
                
                if (count($result) == 4) {

                    session_start();
                    $_SESSION['username'] = $data[0];
                    $_SESSION['id'] = $data[2];
                    $_SESSION['surname'] = $data[1];
                    $_SESSION['tipo'] = $data[3];
                    $_SESSION['email'] = $email;
                    $_SESSION['carrello'] = new CarrelloClass();
                    if (isset($_POST['remember']) && $_POST['remember']) {
                        $db->updateToken($data[2],$email);
                    } else {
                        $db->updateUltimoAccesso($email);
                        setcookie("n");
                        setcookie("t");
                    }

                    $db->close();        
                    header("Location: index.php");
                } else {
                    $db->close();
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
