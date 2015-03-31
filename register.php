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
                    if(!re.test(mail)){
                         alert("Attenzione, mail inserita non valida");
                         return false;
                    }
                    var confmail=   document.forms["register"]["confEmail"].value;
                    
                    if(mail.localeCompare(confmail)!==0)
                    {
                        alert("Attenzione, mail e conferma devono coincidere");
                        return false;
                    }
                    var password = document.forms["register"]["password"].value;
                    if(password.length<6){
                        alert("Attenzione, la password deve essere di almeno 6 caratteri");
                        return false;
                    }
                    var confpassword =  document.forms["register"]["confPassword"].value;
                    if(password.localeCompare(confpassword)!==0)
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
        include 'scripts/restoreLogin.php';
        session_start();
        goHeaderLogin();
       
       ?>
            
            <div class="registerForm">
                
                <form id="register" method="post" action="doRegister.php" onsubmit="return validateForm()">
                    <?php
                    if(!empty($_POST['email'])){
                    if($_POST['presente']){
                                echo '<p id="errore">Email già registrata</p>';
                            }else{
                                if($_POST['emailDiverse']){
                                    echo '<p id="errore">Le email non coincidono</p>';
                                }else if($_POST['passwordDiverse']){
                                    echo '<p id="errore">Le password non coincidono</p>';
                                }else if($_POST['passwordCorta']){
                                    echo '<p id="errore">Le password deve essere almeno di 6 caratteri</p>';
                                }else{
                                 echo '<p id="errore">Errore database</p>';
                                }
                    }
                    
                                }
                        if(!empty($_POST['email'])){
                            echo '<label>Nome <input type="text" name="name" id="name" value="'.$_POST['nome'].'" required></label><br><br>
                    <label>Cognome <input type="text" name="surname" id="surname" value="'.$_POST['cognome'].'" required></label><br><br>
                    <label>Email <input type="text" name="email" id="email" value="'.$_POST['email'].'" required></label><br><br>
                    <label>Conferma Email <input type="text" name="confEmail" id="confEmail" value="" required></label><br><br>
                    
                    <label>Password<input type="password" name="password" id="password" required></label><br><br>
                    <label>Conferma Password <input type="password" name="confPassword" id="confPassword" value="" required></label><br><br>
                    ';
                    if($_POST['sesso']=="uomo"){
                    echo '<label id="sesso">Maschio  <input type="radio" name="sesso" id="sesso" value="uomo" checked="true"></label><br>
                    <label id="sesso">Femmina <input type="radio" name="sesso" id="sesso" value="donna" ></label><br><br>';       
                    }else{
                        echo '<label id="sesso">Maschio  <input type="radio" name="sesso" id="sesso" value="uomo"></label><br>
                    <label id="sesso">Femmina <input type="radio" name="sesso" id="sesso" value="donna"  checked="true"></label><br><br>';  
                    }
                      if($_POST['tipo']==0){
                        echo '<label id="tipo">Standard  <input type="radio" name="tipo" id="tipo" value="0" checked="true"></label><br>
                        <label id="tipo">Commerciante <input type="radio" name="tipo" id="tipo" value="1" ></label><br><br>';
                      }else{
                            echo '<label id="tipo">Standard  <input type="radio" name="tipo" id="tipo" value="0"></label><br>
                        <label id="tipo">Commerciante <input type="radio" name="tipo" id="tipo" value="1" checked="true"></label><br><br>';
                        }
                     }else{
                    ?>
                    
                    
                    
                    
                    
                    <label>Nome <input type="text" name="name" id="name" required></label><br><br>
                    <label>Cognome <input type="text" name="surname" id="surname" required></label><br><br>
                    <label>Email <input type="text" name="email" id="email" required></label><br><br>
                    <label>Conferma Email <input type="text" name="confEmail" id="confEmail" required></label><br><br>
                    
                    <label>Password<input type="password" name="password" id="password" required></label><br><br>
                    <label>Conferma Password <input type="password" name="confPassword" id="confPassword" required></label><br><br>
                    
                    <label id="sesso">Maschio  <input type="radio" name="sesso" id="sesso" value="uomo" checked="true"></label><br>
                    <label id="sesso">Femmina <input type="radio" name="sesso" id="sesso" value="donna" ></label><br><br>
                    
                    <label id="tipo">Standard  <input type="radio" name="tipo" id="tipo" value="0" checked="true"></label><br>
                    <label id="tipo">Commerciante <input type="radio" name="tipo" id="tipo" value="1" ></label><br><br>
                     <?php
                     
                     }
                     ?>
                    
                    <input type="submit" class="submit" value="Registrati">
                    
                    
                    
              </form>
                
                
            </div>
            
            
        </div>
        
        
        <?php
        // put your code here
        ?>
    </body>
</html>
