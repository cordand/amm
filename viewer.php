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
        <link href="styles/viewerCss.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />  
        <?php
        include 'template/header.php';
        include 'template/sidebar.php';
        include 'scripts/restoreLogin.php';

        session_start();
        
        
        if(isset($_GET['id'])){
            
            $id=htmlspecialchars($_GET['id']);
            if(strlen($id)==0){
                echo "Elemento non trovato";
                die();
            }
            $conn=dbConnect('mysite');
            $sql = "SELECT nome,descrizione,immagine,disponibili,prezzo FROM items WHERE id = '".$id."'";
            
            $result = mysql_query($sql); 

            $data=  mysql_num_rows($result);
                    if($data==1){
                         $data=mysql_fetch_row($result);
                         $nome=$data[0];
                         $descrizione=$data[1];
                         $immagine=$data[2];
                         $disponibili=$data[3];
                         $prezzo=$data[4];
                         
                         ?>
        <title><?php echo $nome;?></title>
    </head>
    <body>
        <div id="all">
            
        <?php
        goHeader();
        goSidebar();
        ?>
                             <div id="contenuto">
                <h1 id="titolo"><?php echo $nome ?></h1>
                <div id="descrizione">
                    <img src="<?php echo $immagine ?>">
                    <p><?php echo $descrizione ?>
                    </p>
                    <p>
                        <b>Costo: <?php echo $prezzo ?> €</b>
                    </p>
                    <?php
                        if(isset($_SESSION['username'])&&isset($_SESSION['tipo']) && isset($_SESSION['surname'])){
                            if($_SESSION['tipo']==0){
                    ?>
                    <form action="carrello.php?add=true&id=<?php echo htmlspecialchars($_GET['id'])?>" method="post" >
                        <input type="submit" value="Aggiungi">
                      </form>
                    <?php
                        
                    
                            }
                            
                            }
                        ?>
                </div>
            </div>
                             
                             
                             
                             
                             <?php
                    }  else {
                       echo "Elemento non trovato";
                       die(); 
                    }
            
            
            
            
        
        }else{
            echo "Elemento non trovato";
            die();
        }
        
        
       ?>
            
          
            
            
            
        </div>
        <?php
        // put your code here
        ?>
    </body>
    
</html>
