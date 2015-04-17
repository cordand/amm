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

        <title>Homepage</title>
    </head>
    <body>
        <div id="all">

            <?php
            include 'modello/restoreLogin.php';
            include_once 'modello/ElementiHome.php';
            session_start();
            $db = new ManageDatabase("mysite");
            goHeader();
            goSidebar($db);
            ?>








            


            <ul class="flex-container">
                <?php
               
                $el = new ElementiHome($db);
                echo $el->getElementi();
                ?>



            </ul>
            <?php
                
            ?>
            
        </div>            





    </body>


</html>
