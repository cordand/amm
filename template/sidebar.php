<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printSidebar($db,$loggato, $tipo, $email) {
    
    if (!$loggato) {
        ?>
        
        <nav id="sidebar">
            <h3><a href="index.php?comando=profilo">Posta</a></h3>
            <ul>
                <li id="contatore">Messaggi: <?php echo 0; ?></li>
            </ul>   
        </nav>
        <?php
    } else {
        if ($tipo) {
            ?>
            <nav id="sidebar">
                
                <h3><a href="index.php?comando=cerca&query=::<?php echo $_SESSION['id']?>">Vetrina</a></h3>
                <ul>
                    <li id="contatore">Elementi:  <?php echo $db->getNumeroInserzioni($_SESSION['id']); ?></li>
                </ul>   
            </nav>
            <?php
        } else {
            if(session_status()!=PHP_SESSION_ACTIVE)
                session_start();
            ?>
            <nav id="sidebar">
                <h3><a href="index.php?comando=profilo">Posta</a></h3>
                <ul class="lista">
                    <?php 
                        
                        $num=$db->countMessagesById($_SESSION['id']);
                    ?>
                    <li id="contatore">Messaggi:  <?php echo $num; ?></li><br>
                    
                    <?php 
                    
                    
                    
                    ?>
                    
                </ul>   
            </nav>
            <?php
        }
    }
}
?>
