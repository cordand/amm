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
                if(descrizione.length==0)
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
            goHeader();
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
                            if(strlen($nome)<6){
                                echo "ERRORE NOME";
                                die();
                            }
                            $descrizione=  htmlspecialchars($_POST['descrizione']);
                            if(strlen($descrizione)<6){
                                echo "ERRORE descrizione";
                                die();
                            }
                            $prezzo=  htmlspecialchars($_POST['prezzo']);
                            if(strlen($prezzo)==0){
                                echo "ERRORE prezzo";
                                die();
                            }
                            if (!empty($_POST['immagine'])) {
                                $immagine = htmlspecialchars($_POST['immagine']);
                            }else{
                                $immagine="";
                            }
                            if (!empty($_POST['disponibili'])) {
                                $disponibili = htmlspecialchars($_POST['disponibili']);
                            }else{
                                $disponibili=5;
                            }



                            dbConnect("mysite");
                            
                            if (!addItem($nome, $descrizione, $prezzo, $immagine, $_SESSION['username']." ".$_SESSION['surname'], $_SESSION['email'], $disponibili)) {
                               echo "Errore database";
                            } else {
                                printSuccesso();
                                
                                $sql= "SELECT id FROM items WHERE nome='$nome' AND
                                        descrizione='$descrizione' AND
                                        prezzo='$prezzo' AND
                                        emailinserzionista='".$_SESSION['email']."'";
                                $id=getId($nome, $descrizione, $prezzo, $_SESSION['email']);
                                if($id!=-1){
                                    header( "refresh:3; url=index.php?comando=view&id=".$id ); 
                            }
                            }
                            
                            
                        }
                        
                        
                        
                        
                    }else{
                        printBody();
                    }  
                    }else{
                
                        printBody();
            }
            }
            
            function printSuccesso(){
                ?>
                    <div><h1>Contenuto aggiunto con successo</h1>
                   <?php
            }
            
            function printBody(){
                ?>
                <div class="itemForm">
            <h1>Aggiunta nuovo elemento</h1>
            <form id="newItem" action="index.php?comando=aggiungiItem&add=true" method="post" onsubmit="return checkForm()">
                    <label for="nome">Nome:<input id="nome" name="nome" type="text"></label><br><br>
                    <label for="categoria">Categoria:<select name="categoria" id=""categoria>
                        <option value="0">Primo</option>
                        <option value="1">Secondo</option>

                        </select></label><br><br> 
                    <label for="immagine">URL Immagine:<input name="immagine" id="immagine" type="text"></label><br><br>
                    <label for="descrizione">Descrizione:<textarea name="descrizione" id="descrizione" rows="10" cols="50"></textarea> </label><br><br>
                    <label for="disponibili">Disonibili:<input id="disponibili" name="disponibili" value="5" type="text"></label><br><br> 
                    <label for="prezzo">Prezzo (€):<input id="prezzo" name="prezzo" type="text"></label><br><br> 
                    <button class="submit" type="submit" id="invia" name="invia">Inserisci</button>
                    
                    
                    
                    
                </form>
            </div>
                            <?php
                
                
            }
            
            
            ?>
                
           
        </div>

    </body>

</html>
