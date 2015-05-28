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
        <script src="scripts/jquery.min.js"></script>
        <script type='text/javascript'> var $_REQUEST = <?php echo!empty($_REQUEST) ? json_encode($_REQUEST) : 'null'; ?>;</script>
        <script type='text/javascript'>

        </script>
        <script>
            $varia = 10;
            $fine = false;


        </script>
        <script>
            $(document).ready(function () {
                loadData();
                //Hide Loader for Infinite Scroll
                $('div.ajaxloader').hide();

            });

            function loadData() {
                if ($fine)
                    return;
                var $entries = $('.flex-container'),
                        $loader = $('.ajaxloader', $entries).show();
                if ($_REQUEST != null && ($_REQUEST['query'] != null))
                    $query = ($_REQUEST['query']);
                else
                    $query = "";


                $.get('/vista/getitems.php', {ultimo: $varia, query: $query}, function (data) {
                    if (data !== 0) {
                        if ($varia === 10)
                            $varia += 10;
                        else
                            $varia += 20;
                        $entries.append(data).append($loader.hide());
                    }
                    else {
                        $fine = true;
                    }


                });
            }
            ;




            $(window).scroll(function () {
                if ($(window).scrollTop() >= $(document).height() - $(window).height() - 100) {
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
            goHeader($db);
            goSidebar($db);
            ?>











            <ul class="flex-container">
                <?php
                $el = new ElementiHome($db);
                if (isset($_REQUEST['query'])) {
                    echo $el->getElementi(-1, $_REQUEST['query']);
                } else {

                    echo $el->getElementi(-1, "");
                }
                $db->close();
                ?>



            </ul>
            <?php
            printFooter();
            ?>

        </div>            
        <div class="ajaxloader">

        </div>





    </body>


</html>
