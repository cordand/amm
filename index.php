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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />  


        <title>Homepage</title>
    </head>
    <body>
        <div id="all">

            <?php
            include 'template/header.php';
            include 'scripts/restoreLogin.php';

            session_start();
            goHeader();
            ?>








            <nav id="sidebar">
                <h3><a href="carrello.php">Carrello</a></h3>
                <ul>
                    <li id="contatore">Elementi: 0</li>
                </ul>   
            </nav>


            <ul class="flex-container">
                <?php
                dbConnect("mysite");
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit 10";
                $result = mysql_query($sql);
                $num = mysql_num_rows($result);
                for ($i = 0; $i < $num; $i++) {
                    $data = mysql_fetch_row($result);
                    ?>
                    <div class="flex-item">
                        <a href="viewer.php?id=<?php echo $data[0] ?>">
                            <img class="flex-image" src="<?php echo $data[3] ?>">
                        </a>
                        <a href="viewer.php?id=<?php echo $data[0] ?>">
                            <span>
                                <div class="box">
                                    <div class="text">
                                        <?php echo $data[1] ?>
                                    </div>
                                </div>
                            </span>
                        </a>
                        <p class="prezzo">
                            <?php echo $data[4] ?> €
                        </p>

                    </div>


                    <?php
                }
                ?>



            </ul>
        </div>            





    </body>


</html>
