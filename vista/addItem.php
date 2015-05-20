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
        <link href="styles/addItemCss.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />  
        
        
        <script>
            function checkForm() {
                var nome = document.forms["newItem"]["nome"].value;
                if(nome.length<6)
                {
                    alert("Il nome richiede almeno 6 caratteri");
                    return false;
                }
                var descrizione = document.forms["newItem"]["descrizione"].value;
                if(descrizione.length<6)
                {
                    alert("La descrizione richiede almeno 6 caratteri");
                    return false;
                }
                var prezzo = document.forms["newItem"]["prezzo"].value;
                if(prezzo.length==0)
                {
                    alert("Non è stato inserito nessun prezzo");
                    return false;
                }
            }
         </script>
        
        <title>Aggiungi elemento</title>
    </head>
    <body>
        <div id="all">
            <?php
            include 'template/header.php';
            include 'modello/restoreLogin.php';
            session_start();
            $db=new ManageDatabase("mysite");
            goHeader($db);
            $db->close();
            if(!isset($_SESSION['tipo']))
            {
                header("Location: index.php");
            }else if($_SESSION['tipo']==0){
                header("Location: index.php");
            }else{
                if(isset($_GET['add'])){
                    if($_GET['add']){
                        if (!empty($_POST['nome']) && !empty($_POST['descrizione'])&& !empty($_POST['prezzo'])) {
                            $nome=  htmlspecialchars($_POST['nome']);
                            $descrizione=  htmlspecialchars($_POST['descrizione']);
                            $prezzo=  htmlspecialchars($_POST['prezzo']);
                             $disponibili = htmlspecialchars($_POST['disponibili']);
                            if(!empty($_POST['immagine']))
                                $immagine = htmlspecialchars($_POST['immagine']);
                            else {
                                $immagine ="";
                            }
                            if(strlen($nome)<6){
                                printbody("Nome non valido",$nome,$descrizione,$immagine,$prezzo,$disponibili);
                                die();
                            }
                          
                            if(strlen($descrizione)<6){
                                 printbody("Descrizione non valida",$nome,$descrizione,$immagine,$prezzo,$disponibili);
                                die();
                            }
                            
                            if(strlen($prezzo)==0|| !is_numeric($prezzo)||$prezzo<=0){
                                printbody("Prezzo non valido",$nome,$descrizione,$immagine,$prezzo,$disponibili);
                                die();
                            }
                            if (!empty($_POST['immagine'])) {
                                if (filter_var($_POST['immagine'], FILTER_VALIDATE_URL) === FALSE) {
                                    printbody("Immagine non valida",$nome,$descrizione,$immagine,$prezzo,$disponibili);
                                    die();
                                    }
                                $immagine = htmlspecialchars($_POST['immagine']);
                            }else{
                                $immagine="";
                            }
                            if (strlen($disponibili)==0||!is_numeric($disponibili)||$disponibili<=0) {
                               printbody("Disponibilità non valida",$nome,$descrizione,$immagine,$prezzo,$disponibili);
                               die();
                            }



                          
                            $db = new ManageDatabase("mysite");
                            if (!$db->addItem($nome, $descrizione, $prezzo, $immagine, $_SESSION['username']." ".$_SESSION['surname'], $_SESSION['id'],$_SESSION['email'], $disponibili)) {
                               $db->close();
                               ?><strong>Errore, riprovare pi&ugrave; tardi</strong>
                                   <?php
                            } else {
                                printSuccesso();
                                
                                $id=$db->getId($nome, $descrizione, $prezzo, $_SESSION['email']);
                                if($id!=-1){
                                    $db->close();
                                    header( "refresh:3; url=index.php?comando=view&id=".$id ); 
                            }else{
                                 $db->close();
                            }
                            }
                            
                            
                        }
                        
                        
                        
                        
                    }else{
                        printBody("","","","",0,0);
                    }  
                    }else{
                
                        printBody("","","","",0,0);
            }
            }
            
            function printSuccesso(){
                ?>
                    <div><h1>Contenuto aggiunto con successo</h1>
                   <?php
            }
            
            function printBody($errore,$nome,$descrizione,$immagine,$prezzo,$disponibili){
                ?>
                <div class="itemForm">
            <h1>Nuovo elemento</h1>
            <form id="newItem" action="index.php?comando=aggiungiItem&add=true" method="post" onsubmit="return checkForm()">
                <p class="errore"> <?php echo $errore; ?>   </p>
                <label for="nome">Nome:<br><input id="nome" name="nome" type="text" value="<?php echo $nome?>"></label><br><br>
<!--                    <label for="categoria">Categoria:<select name="categoria" id=""categoria>
                        <option value="0">Primo</option>
                        <option value="1">Secondo</option>

                        </select></label><br><br> -->
                    <label for="immagine">URL Immagine:<input name="immagine" id="immagine" type="text" value="<?php echo $immagine?>"></label><br><br>
                    <label for="descrizione">Descrizione:<textarea name="descrizione" id="descrizione" rows="10" cols="50" ><?php echo $descrizione?></textarea> </label><br><br>
                    <label for="disponibili">Disponibili:<input id="disponibili" name="disponibili" value="5" type="text" value="<?php echo $disponibili?>"></label><br><br> 
                    <label for="prezzo">Prezzo (€):<input id="prezzo" name="prezzo" type="text" value="<?php echo $prezzo?>"></label><br><br> 
                    <input class="submit" type="submit" id="invia" name="invia" value="Inserisci">
                    
                    
                    
                    
                </form>
            </div>
                            <?php
                
                
            }
            
            
            ?>
                
           
        </div>

    </body>

</html>
