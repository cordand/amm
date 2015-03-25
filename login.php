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
        <div id="topBar">
             
                <nav>
                    <ul>

                            <li><a href="#"></a>
                                    <ul>
                                            <li><a href="login.php">Login</a></li>

                                            </li>
                                    </ul>
                            </li>
                            
                    </ul>
   </nav>
            </form>
             
         </div>
    <header id="header">
        <a href="index.php"><img title="header" src="images/header.png"/></a>
        
        
    </header>
        
        
            
            <div class="loginForm">
                <form id="login" action="doLogin.php">
                    <label>Email <input type="text" name="username" id="username"></label><br><br>
                    <label>Password<input type="text" name="password" id="password"></label><br><br>
                    <label id="ricorda">Ricordami <input type="checkbox" name="remember" id="remember"></label><br><br>
                    <input type="submit" class="submit" value="Login">
              </form>
                
            </div>
         
        </div>
    </body>
</html>
