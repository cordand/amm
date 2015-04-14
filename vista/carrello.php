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
        <link href="styles/carrelloCss.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />  
        <script>
            
        </script>
        <title>Carrello</title>
    </head>
    <body>
        <div id="all">
            <?php
            include 'template/header.php';
            include 'template/sidebar.php';
            include 'modello/restoreLogin.php';
            
            session_start();
            dbConnect("mysite");
            
            if(isset($_GET['add'])){
                if($_GET['add']){
                    if(isset($_POST['id'])){ //aggiungi al carrello questo id
                        if(is_numeric($_POST['quantita'])){
                           $_SESSION['carrello']->aggiungiElemento($_POST['nome'],$_POST['id'],$_POST['prezzo'],$_POST['quantita']);  
                        }else{
                            header("Location: index.php?comando=view&id=".$_POST['id']);
                        }
                        
                    }
                    
                }
            }
            else if(isset($_GET['rm'])){
                $_SESSION['carrello']->rimuoviElemento($_GET['rm']);
                
            }
            goHeader();
            goSidebar();
            ?>

            <table id="carrello">
                <caption>Elementi nel carrello</caption>
                <tr>
                    <th>Nome</th>
                    <th>Prezzo</th> 
                    <th>Quantità</th>
                    <th>Azioni</th>
                </tr>
              
                    <?php
                        $carrello=$_SESSION['carrello']->getElementi();
                        foreach ($carrello as $temp){
                            echo '<tr>';
                            echo '<td>'.$temp->getNome().'</td>';
                            echo '<td>'.$temp->getPrezzo().'</td>';     
                            echo '<td>'.$temp->getQuantita().'</td>';
                            ?>
                                <td>
                                    <form action="index.php?comando=carrello&rm=<?php echo $temp->getId() ?>" method="post">
                                        <input type="submit" value="Rimuovi">
                                    </form>
                                </td>    
                                </tr>
                                <?php
                                
                        }
                        if(count($carrello)==0){
                            echo "<h2>Carrello vuoto</h2>";
                        }
                    ?>
                    
                    
            </table>

        </div>



        <?php
        // put your code here
        ?>
    </body>
</html>
