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
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
        
        
        <?php
        include 'template/header.php';
        include 'template/sidebar.php';
        include 'modello/restoreLogin.php';
        
        session_start();


        if (isset($_GET['id'])) {

            $id = htmlspecialchars($_GET['id']);
            if (strlen($id) == 0) {
                echo "Elemento non trovato";
                die();
            }
            $db = new ManageDatabase("mysite");

            $data = $db->getItem($id);
            if ($data) {
                $nome = $data[0];
                $descrizione = $data[1];
                $immagine = $data[2];
                $disponibili = $data[3];
                $prezzo = $data[4];
                ?>
                <title><?php echo $nome; ?></title>
            </head>
            <body>
                <div id="all">

                    <?php
                    goHeader();
                    goSidebar($db);
                    ?>
                    <div id="contenuto">
                        <h1 id="titolo"><?php echo $nome ?></h1>
                        <div id="descrizione">
                            <img src="<?php echo $immagine ?>" onerror="this.src='images/error.png'">
                            <p><?php echo $descrizione ?>
                            </p>
                            <p>
                                <b>Prezzo: <?php echo $prezzo ?> €</b>
                            </p>
                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['tipo']) && isset($_SESSION['surname'])) {
                                if ($_SESSION['tipo'] == 0) {
                                    ?>
                                    <form action="index.php?comando=carrello&add=true" method="post" >
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']) ?>">
                                        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome) ?>">
                                        <input type="hidden" name="prezzo" value="<?php echo htmlspecialchars($prezzo) ?>">
                                        <input name="quantita" id="quantita" value="<?php echo htmlspecialchars(1) ?>">
                                        <input type="submit" value="Aggiungi">
                                    </form>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>




                    <?php
                } else {
                    goHeader();
                    goSidebar();
                    printNonTrovato();
                    die();
                }
            } else {
                    goHeader();
                    goSidebar();
                    printNonTrovato();
                    die();
                }
            ?>





        </div>
        <?php
        function printNonTrovato(){
                     ?>
                    <div id="contenuto">
                        <h1>Elemento non trovato</h1>
                    </div>
                        <?php 
        }
        ?>
    </body>

</html>
