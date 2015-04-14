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
            include 'modello/restoreLogin.php';
            session_start();
            dbConnect("mysite");
            goHeader();
            goSidebar();
            ?>








            


            <ul class="flex-container">
                <?php
               
                $result=  getIndexItems();
                $num = mysql_num_rows($result);
                $num=1;
                for ($i = 0; $i < $num; $i++) {
                    $data = mysql_fetch_row($result);
                   
                    ?>
                    <div class="flex-item">
                        <a href="index.php?comando=view&id=<?php echo $data[0] ?>">
                            <img class="flex-image" src="<?php echo $data[3] ?>" onerror="this.src='images/error.png'">
                        </a>
                        <a href="index.php?comando=view&id=<?php echo $data[0] ?>">
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
                if($num==0){
                    ?>
                <h2>Non &egrave; presente nessun elemento</h2>
                    <?php
                }
                ?>



            </ul>
            <?php
                
            ?>
            
        </div>            





    </body>


</html>
