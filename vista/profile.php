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
        <link href="styles/profileCss.css" rel="stylesheet">
        <title>Profilo </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" /> 
       <script src="scripts/jquery.min.js"></script>
        <script>$varia =0;
        </script>
        <script>
        
        $(document).ready(function(){
            $("#contatore").click(function(){
                if($varia===0){
                    $(".element").show();
                    $varia=1;
                }else{
                    $(".element").hide();
                    $varia=0;
                }
            });
            
        });
        </script>
        <script>
            jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.document.location = $(this).data("href");
                });
            });
        
        </script>
        
    </head>
    <body>
        
        <div id="all">

            <?php
            
            include 'modello/restoreLogin.php';
            include 'modello/MessaggioClass.php';
            session_start();
            $db=new ManageDatabase("mysite");
            goHeader($db);
            goSidebar($db);
            
            ?>
            
            <div id="tabella">
                 <h2>Informazioni utente</h2>
                <?php
                if(isset($_SESSION['email'])){
                $data=$db->userDetails($_SESSION['email']);}
                else{
                    $data=false;
                }
                
    if($data){
            ?>
            <table>
               
                <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Tipo account</th>
                </tr>    
            <?php
            echo "<tr>";
        echo "<td>" . $data[0] . "</td>";
        echo "<td>" . $data[1]  . "</td>";
        echo "<td>" .$data[2]  . "</td>";
        echo "<td>";
        echo  $data[3]==1 ? "Venditore" : "Compratore"  ;
        echo "</td>";
        echo "</tr>";
        ?>
            </table>
            </div>
            
         <div id="tabellaMessaggi">
             <h2>Messaggi</h2>
               <table>
                <tr>
                <th>Stato</th>
                <th class="prodotto">Prodotto</th>
                <th>Destinatario</th>
                <th>Mittente</th>
                <th>Testo</th>
                <th class="data">Data</th>
                </tr>
                <?php
                    if(!isset($_GET['pagina']))
                        $pagina=0;
                    else{
                        $pagina=$_GET['pagina'];
                    }
                    $numMessaggi=$db->countMessagesById($_SESSION['id']);
                    
                    $messaggi=$db->getMessagesById($_SESSION['id'], $pagina);
                    $db->close();
                    if(count($messaggi)==0){
                        echo '<td colspan="6" class="center"><b>Non sono ancora presenti messaggi.</b></td>';
                    }
                    foreach ($messaggi as $temp){
                          echo "<tr class='clickable-row' data-href='index.php?comando=leggi&amp;id=".$temp->getIdMessaggio()."'>";
                          echo "<td>";
                          echo $temp->getLetto()==1 ? '<img src="images/read_message.png" width="32" height="32" alt="simbolo" >' : '<img src="images/message.png" width="32" height="32" alt="simbolo" >'   . "</td>";
                          echo "<td class=\"prodotto\">";
                          if(strlen($temp->getNomeP())==0){
                              $nomeP="Non trovato";
                          }else if(strlen($temp->getNomeP())<13){
                              $nomeP=getNomeP;
                          }else{
                              $nomeP=substr($temp->getNomeP(),0,12)."...";
                              
                          }
                          echo $nomeP; "</td>";
                          echo "<td>";
                          echo strlen($temp->getNomeD())>12?substr($temp->getNomeD(),0,12)."...":$temp->getNomeD() . "</td>";
                          echo "<td>";
                          echo strlen($temp->getNomeM())>12?substr($temp->getNomeM(),0,12)."...":$temp->getNomeM() . "</td>";
                          echo "<td>";
                          echo  strlen($temp->getTesto())>12?substr($temp->getTesto(),0,12)."...":$temp->getTesto()  . "</td>";
                          echo "<td class=\"data\">" . $temp->getData() . "</td>";
                          echo "</tr>";
                          
                    }
                ?>
             
             
         
             
               </table>
             
             
             
             <?php
                if($numMessaggi>20){
                    $totPagine=  ceil($numMessaggi/20);
//                    if($pagina!=0){
//                        echo "[Indietro]";
//                    }
//                    if($pagina==1&&$pagina!=$totPagine-1){
//                        if ($totPagine > 2) {
//                             echo "<strong>[1]</strong>[2]..[".($totPagine-1)."][Next]";
//                         }
//                     }
//                    else if($pagina==2){
//                        echo "[1]<strong>[2]</strong>";
//                    }
//                    else if($pagina==3){
//                        echo "[1][2]<strong>[3]</strong>";
//                    }
//                    else if($pagina >3&&$pagina!=$totPagine-1){
//                        echo "[1]..[$pagina]..[$totPagine-1][Next]";
//                    }
//                    else if($pagina >3&&$pagina==$totPagine-1){
//                        echo "[1]..[$pagina]";
//                    }
                    
                    if($pagina!=0){
                        echo "<a href=index.php?comando=profilo&amp;pagina=".($pagina-1).">Indietro</a>";
                    }
                    echo " Pagina: ".($pagina+1)."/$totPagine ";
                    if($pagina!=($totPagine-1)){
                        echo "<a href=index.php?comando=profilo&amp;pagina=".($pagina+1).">Avanti</a>";
                    }
                    
                    
                    
                    
                }
             
             ?>
         </div>
        
        
        
        
        
        
        <?php
    }else{
    
    ?>
    Non sei loggato
    <?php
}
                
                
                ?>
     <?php 
            printFooter();
        ?>
            </div>
            
            
            
        
    </body>
</html>
