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
         <link href="styles/contattaCss.css" rel="stylesheet">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />
        <title>Contatta</title>
        <script>
            function checkForm() {
               
                var descrizione = document.forms["newMessage"]["messaggio"].value;
                if(descrizione.length<6)
                {
                    alert("Il messaggio richiede almeno 6 caratteri");
                    return false;
                }
                
            }
         </script>
        
    </head>
    <body>
        <?php
           include 'template/header.php';
           include 'template/sidebar.php';
           include 'modello/restoreLogin.php';     
           session_start();
           
           
        ?>
        <div id="all">
            <?php
           $db = new ManageDatabase("mysite");
           goHeader($db);
           goSidebar($db);
           
           if(isset($_POST['send'])&&$_POST['send']){
               if(isset($_POST['risposta'])&&$_POST['risposta']){
                   $id_inserzionista=$_POST['destinatario'];
               }else{
                $id_inserzionista = $db->getItemInserzionista(htmlspecialchars($_POST['id']));
               }
              
              $id_mittente=$_SESSION['id'];
              
           if(($id=$db->sendMessage( $id_mittente, $id_inserzionista, htmlspecialchars($_POST['id']), htmlspecialchars($_POST['messaggio'])))){
               header("Location: index.php?comando=leggi&id=".$id);
               
           }else{
               echo "Errore, riprovare in seguito";
               
           }
           $db->close();
              
           }else
           {
               
              $dest= $db->getIdDetails($db->getItemInserzionista($_POST['id']));
              
           ?>
             <div class="itemForm">
            <h2>Invio messaggio</h2>
            <h3>Destinatario: </h3>
            <p><strong><?php echo $dest; ?></strong></p>
            <form id="newMessage" action="index.php?comando=contatta" method="post" onsubmit="return checkForm()">
            <label for="messaggio"><strong>Messaggio:</strong><textarea name="messaggio" id="messaggio" rows="10" cols="50"></textarea> </label><br><br>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id']) ?>">
            <?php if(isset($_POST['risposta'])&&$_POST['risposta']){
                if(isset($_POST['destinatario'])){
                    ?>
                       <input type="hidden" name="destinatario" value="<?php echo htmlspecialchars($_POST['destinatario']) ?>"> 
                        <input type="hidden" name="risposta" value="<?php echo htmlspecialchars($_POST['risposta']) ?>"> 
                            <?php
                }
            }
            ?>
            
            <input type="hidden" name="send" value="true">
            <input class="submit" type="submit" id="invia" name="invia" value="Invia">
                    
                    
                    
                    
                </form>
            </div>
            
            <?php
           }
           ?>
             <?php 
            printFooter();
        ?>
        </div>
    </body>
</html>
