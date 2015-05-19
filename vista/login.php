<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="styles/myCss.css" rel="stylesheet">
        <link href="styles/loginCss.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />    
        <title>Login</title>

        

    </head>
    <body>
        <div id="all">
            <?php
            
            include 'modello/restoreLogin.php';
            session_start();
            $db = new ManageDatabase("mysite");
            goHeader($db);
            //goSidebar($db);
            $db->close();
            if (!empty($_POST['email'])){
                if (!$_POST['success']){
                    ?>
                       <div class="loginForm errore" > 
                        <?php
                }else{
                    ?>
                       <div class="loginForm" > 
                        <?php
                }
            }else{
                ?>
                       <div class="loginForm" > 
                        <?php
            }
            ?>
            
            
                
                <form id="login" method="post" action="index.php?comando=doLogin">
                    <h3>Login</h3>
                    <?php
                    if (!empty($_POST['email'])) {
                        
                        if (!$_POST['success']) {
                            echo '<p id="errore"> Email o password errata</p>';
                            echo '<label>Email <input type="text" name="email" id="email" value="' . htmlspecialchars($_POST["email"]) . '" required></label><br><br>';
                            echo ' <script>
                                document.getElementById(\'login\').style.height="200px";
                            </script>';
                        } else {
                            echo '<p"> Iscrizione avvenuta! Ora puoi effettuare il login</p>';
                            echo '<label>Email <input type="text" name="email" id="email" value="' . htmlspecialchars($_POST["email"]) . '" required></label><br><br>';
                            echo ' <script>
                                document.getElementById(\'login\').style.height="200px";
                            </script>';
                        }
                    } else {

                        echo '<label>Email <input type="text" name="email" id="email" required></label><br><br>';
                    }
                    ?>
                    <label>Password<input type="password" name="password" id="password" required></label><br><br>
                    <label id="ricorda">Ricordami <input type="checkbox" name="remember" id="remember"> </label><br><br>
                    <input type="submit" class="submit" value="Login">
                </form>

            </div>

            <div class="registerForm">
                <form id="register" action="index.php?comando=register" method="post">
                    <h3>Registrazione</h3>
                    <p>Non ancora registrato? Registrati ora!</p>
                    <input type="submit" class="submit" value="Registrati">
                </form>

            </div>         
        </div>
    </body>
</html>
