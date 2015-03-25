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
            
            if(!empty($_GET['username']) && !empty($_GET['password'])){
                $user= htmlspecialchars($_GET["username"]) ;
                $password= htmlspecialchars($_GET["password"]) ;
                
                echo 'login';
                exit(0);
            }
            else{  
                header("Location: login.php");
                die();
            }
            
        ?>
    </body>
</html>
