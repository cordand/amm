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
        <script>
            function validateForm() {
                var mail = document.forms["register"]["email"].value;

                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (!re.test(mail)) {
                    alert("Attenzione, mail inserita non valida");
                    return false;
                }
                var confmail = document.forms["register"]["confEmail"].value;

                if (mail.localeCompare(confmail) !== 0)
                {
                    alert("Attenzione, mail e conferma devono coincidere");
                    return false;
                }
                var password = document.forms["register"]["password"].value;
                if (password.length < 6) {
                    alert("Attenzione, la password deve essere di almeno 6 caratteri");
                    return false;
                }
                var confpassword = document.forms["register"]["confPassword"].value;
                if (password.localeCompare(confpassword) !== 0)
                {
                    alert("Attenzione, password e conferma non coincidono");
                    return false;
                }

            }

        </script>
        <title>Registrati</title>
    </head>
    <body>

        <div id="all">
            <?php
            include 'template/header.php';
            include 'modello/restoreLogin.php';
            
            session_start();
            $db = new ManageDatabase("mysite");
            goHeader($db);
            $db->close();
            ?>

            <div class="registerForm">

                <form id="register" method="post" action="index.php?comando=doRegister" onsubmit="return validateForm()">
                    <h3>Registrazione</h3>
                    <?php
                      $value=new UserReg("","","","","",0,0);
                      
                    if (!empty($_SESSION['userReg'])) {
                        $value=$_SESSION['userReg'];
                        $errorCode=$_POST['errorcode'];
                        switch($errorCode){
                            case ErrorCode::EMAILPRESENTE:{
                                echo '<p id="errore">Email già registrata</p>';
                                break;
                            }
                            case ErrorCode::EMAILDIVERSE:{
                                echo '<p id="errore">Le email non coincidono</p>';
                                break;
                            }
                            case ErrorCode::PASSWORDDIVERSE:{
                                echo '<p id="errore">Le password non coincidono</p>';
                                break;
                            }
                            case ErrorCode::PASSWORDCORTA:{
                                echo '<p id="errore">Le password deve essere almeno di 6 caratteri</p>';
                                break;
                            }
                            case ErrorCode::ERROREDATABASE:{
                                echo '<p id="errore">Errore database</p>';
                                break;
                            }
                            case ErrorCode::ERROREGENERICO:{
                                echo '<p id="errore">Errore</p>';
                                break;
                            }
                        }
                        unset($_SESSION['userReg']);
                    }
                    
                        





                        echo '<label>Nome <input type="text" name="name" id="name" value="'.($value->getNome()).'" required></label><br><br>';
                        echo '<label>Cognome <input type="text" name="surname" id="surname" value="'.($value->getCognome()).'" required></label><br><br>';
                        echo '<label>Email <input type="text" name="email" id="email" value="'.($value->getEmail()).'" required></label><br><br>';
                        echo '<label>Conferma Email <input type="text" name="confEmail" id="confEmail" required></label><br><br>';
                        echo '<label>Via <input type="text" name="via" id="via" value="'.($value->getVia()).'" required></label><br><br>';
                        echo '<label>Citt&agrave; <input type="text" name="citta" id="citta" value="'.($value->getCitta()).'" required></label><br><br>';
                        echo '<label>Password<input type="password" name="password" id="password" required></label><br><br>';
                        echo '<label>Conferma Password <input type="password" name="confPassword" id="confPassword" required></label><br><br>';
                        if($value->getSesso()==0){
                            echo '<label >Maschio  <input type="radio" name="sesso0" id="sesso0" value="uomo" checked></label><br>';
                            echo '<label >Femmina <input type="radio" name="sesso1" id="sesso1" value="donna" ></label><br><br>';
                        }
                        else{
                            echo '<label ">Maschio  <input type="radio" name="sesso0" id="sesso0" value="uomo" ></label><br>';
                            echo '<label >Femmina <input type="radio" name="sesso1" id="sesso1" value="donna" checked></label><br><br>';
                        }
                        if($value->getTipo()==0){
                            echo '<label>Standard  <input type="radio" name="tipo0" id="tipo0" value="0" checked></label><br>';
                            echo '<label>Commerciante <input type="radio" name="tipo1" id="tipo1" value="1" ></label><br><br>';
                        }else{
                            echo '<label>Standard  <input type="radio" name="tipo0" id="tipo0" value="0" ></label><br>';
                            echo '<label>Commerciante <input type="radio" name="tipo1" id="tipo1" value="1" checked></label><br><br>';
                          
                        }
                    
                    ?>

                    <input type="submit" class="submit" value="Registrati">



                </form>


            </div>

          <?php 
            printFooter();
        ?>       
        </div>


        <?php
// put your code here
        ?>
    </body>
</html>
