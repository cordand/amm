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
        <link href="styles/carrelloCss.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />  
        <script>
            function SomeDeleteRowFunction() {
                var f = document.createElement('form');
                f.action = 'carrello.php';
                f.method = 'POST';
                f.target = '_blank';

                var i = document.createElement('input');
                i.type = 'hidden';
                i.name = 'riga';
                i.value = 1;
                f.appendChild(i);

                document.body.appendChild(f);
                f.submit();
            }
        </script>
        <title>Carrello</title>
    </head>
    <body>
        <div id="all">
            <?php
            include 'template/header.php';
            include 'scripts/restoreLogin.php';
            session_start();
            goHeader();
            ?>

            <table id="carrello">
                <caption>Elementi nel carrello</caption>
                <tr>
                    <th>Nome</th>
                    <th>Quantità</th> 
                    <th>Prezzo</th>
                    <th>Azioni</th>
                </tr>
                <tr>
                    <td>Eve</td>
                    <td>Jackson</td> 
                    <td>94</td>
                    <td><button type="button" onclick="SomeDeleteRowFunction()">Rimuovi</button></td>
                </tr>
            </table>

        </div>



        <?php
        // put your code here
        ?>
    </body>
</html>
