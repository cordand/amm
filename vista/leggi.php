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
        <link href="styles/leggiCss.css" rel="stylesheet">
        <title>Leggi Messaggio</title>
    </head>
    <body>
        <?php
           include 'template/header.php';
           include 'template/sidebar.php';
           include 'modello/restoreLogin.php';    
           include 'modello/MessaggioClass.php';
           session_start();
           
           
        ?>
        <div id="all">
            <?php
           $db = new ManageDatabase("mysite");
           goHeader($db);
           goSidebar($db);
           
           $msg=$db->getMessaggioById($_GET['id'],$_SESSION['id']);
           if(!$msg){
               echo "Messaggio non trovato";
               die();
           }else{
           ?>
            <div class="messaggio">
                <h2>Messaggio</h2>
                <table>
                    <tr>
                        <th>Prodotto</th>
                    </tr>
                    <tr>
                        <td><?php echo strlen($msg->getNomeP())>0?$msg->getNomeP():"Non trovato"?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Mittente</th>
                    </tr>
                    <tr>
                        <td><?php echo $msg->getNomeM()?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Destinatario</th>
                    </tr>
                    <tr>
                        <td><?php echo $msg->getNomeD()?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Data</th>
                    </tr>
                    <tr>
                        <td><?php echo $msg->getData()?></td>
                    </tr>
                </table>
                <table  class="testo">
                    <tr>
                        <th>Testo</th>
                    </tr>
                    <tr>
                        <td><?php echo $msg->getTesto()?></td>
                    </tr>
                </table>
                <?php
                
                if($msg->getIdDestinatario()===$_SESSION['id']){
                    $db->setLetto($msg->getIdMessaggio(),$_SESSION['id']);
                }
           }
                
            if($msg->getIdMittente()!=$_SESSION['id']){
                ?>
            <form action="index.php?comando=contatta" method="post">
                <input type="hidden" name="id" value="<?php echo $msg->getIdProdotto() ?>">
                <input type="hidden" name="risposta" value="true">
                <input type="hidden" name="destinatario" value="<?php echo $msg->getIdMittente() ?>">
                <input type="submit" class="rispondi" value="Rispondi">
            </form>
            <?php
            
            
            }
            ?>
        </div>
            <div class="spazio">
                
            </div>
             <?php 
            printFooter();
        ?>
        </div>
            
    </body>
</html>
