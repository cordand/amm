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
        <script type='text/javascript'> var $_POST = <?php echo !empty($_POST)?json_encode($_POST):'null';?>; </script>
     <script type='text/javascript'>
       
     </script>
        <script>
            $varia = 10;
            $fine = false;
            
            
        </script>
        <script>
            $(document).ready(function () {
                loadData(0);
                //Hide Loader for Infinite Scroll
                $('div.ajaxloader').hide();

            });

            function loadData(last_id) {
                if ($fine)
                    return;
                var $entries = $('.flex-container'),
                        $loader = $('.ajaxloader', $entries).show();
                if($_POST!=null&&($_POST['query']!=null))
                    $query=($_POST['query']);
                else 
                    $query="";
                $.get('/vista/getitems.php', {ultimo: $varia, query:$query}, function (data) {
                    if (data != 0){
                        if ($varia == 10)
                            $varia += 10;
                        else
                            $varia += 20;
                        $entries.append(data).append($loader.hide());
                    }
                    else{
                        $fine = true;
                    }
                    
                    
                });
            }
            ;


//Isotope filter - no changes to this code so I didn't include it

            $(window).scroll(function () {
                if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                    $('div.ajaxloader').show('slow');
                    loadData($varia);
                }
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
                if (isset($_POST['query'])) {
                    echo $el->getElementi(-1, $_POST['query']);
                } else {
                    echo $el->getElementi(-1, "");
                }
                ?>



            </ul>
            <?php
            ?>

        </div>            
        <div class="ajaxloader">

        </div>




    </body>


</html>
