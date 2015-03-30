<?php
        include 'scripts/manageDatabase.php';
            
            if(!empty($_POST['email']) && !empty($_POST['password'])){
                $email= htmlspecialchars($_POST["email"]) ;
                $password= htmlspecialchars($_POST["password"]) ;
                $nome=htmlspecialchars($_POST["name"]) ;
                $cognome=htmlspecialchars($_POST["surname"]) ;
                $sesso=htmlspecialchars($_POST["sesso"]) ;
                $conn=dbConnect('mysite');
                $sql = "SELECT COUNT(*) FROM users WHERE email = '".$email."'";
                $result = mysql_query($sql);
                if (!$result) {
                echo ('A database error occurred in processing your '.
                'submission.\nIf this error persists, please '.
                'contact you@example.com.');
                }
                if (@mysql_result($result,0,0)>0) {
                echo('A user already exists with your chosen userid.\n'.
                'Please try another.');
                }else{
                     $sql = "INSERT INTO users SET
                    nome = '$nome',
                    cognome = '$cognome',
                    email = '$email',        
                    password = PASSWORD('$password'),
                    sesso = '$sesso'";
                     if (!mysql_query($sql))
                        echo('A database error occurred in processing your '.
                        'submission.\nIf this error persists, please '.
                        'contact you@example.com.');
                     else
                     {
                         echo "RIUSCITO";
                     }
                }
                exit(0);
            }
            else{  
                header("Location: login.php");
                die();
            }
            
        ?>
