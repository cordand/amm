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
        <title>Registrati</title>
    </head>
    <body>
        
        <div id="all">
            <div id="topBar">
             
                <nav>
                    <ul>

                            <li><a href="#"></a>
                                    <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="login.php">Login</a></li> 
                                    </ul>
                            </li>
                            
                    </ul>
   </nav>
            </form>
             
         </div>
            <header id="header">
        <div class="immagineHeader">
            <a href="index.php"><img title="Home" src="images/header.png"/></a>
        </div>
        <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="news.asp">News</a></li>
        <li><a href="contact.asp">Contact</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </header>
            
            <div class="registerForm">
                <form id="register" method="post" action="doRegister.php">
                    <label>Nome <input type="text" name="name" id="name"></label><br><br>
                    <label>Cognome <input type="text" name="surname" id="surname"></label><br><br>
                    <label>Email <input type="text" name="email" id="email"></label><br><br>
                    <label>Conferma Email <input type="text" name="confUsername" id="confUsername"></label><br><br>
                    
                    <label>Password<input type="password" name="password" id="password"></label><br><br>
                    <label>Conferma Password <input type="password" name="confPassword" id="confPassword"></label><br><br>
                    
                    <label id="ricorda">Maschio  <input type="radio" name="sesso" id="sesso" value="uomo" checked="true"></label><br>
                    <label id="ricorda">Femmina <input type="radio" name="sesso" id="sesso" value="donna" ></label><br><br>
                    
                    
                    <input type="submit" class="submit" value="Registrati">
              </form>
                
                
            </div>
            
            
        </div>
        
        
        <?php
        // put your code here
        ?>
    </body>
</html>
