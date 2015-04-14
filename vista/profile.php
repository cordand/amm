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
            <div id="tabella">
                <?php
                $data=userDetails($_SESSION['email']);
    if($data!=null){
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
        
    }else{
    
    ?>
    Non sei loggato
    <?php
}
                
                
                ?>
            </div>
            
            
            
        </div>
    </body>
</html>
