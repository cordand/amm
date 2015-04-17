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
            <h3><a href="index.php?comando=carrello">Carrello</a></h3>
            <ul>
                <li id="contatore">Elementi: <?php echo 0; ?></li>
            </ul>   
        </nav>
        <?php
    } else {
        if ($tipo) {
            ?>
            <nav id="sidebar">
                <h3><a href="index.php?comando=vetrina">Vetrina</a></h3>
                <ul>
                    <li id="contatore">Elementi:  <?php echo $db->getNumeroInserzioni($email); ?></li>
                </ul>   
            </nav>
            <?php
        } else {
            if(session_status()!=PHP_SESSION_ACTIVE)
                session_start();
            ?>
            <nav id="sidebar">
                <h3><a href="index.php?comando=carrello">Carrello</a></h3>
                <ul class="lista">
                    <?php 
                        $elementi=$_SESSION['carrello']->getElementi();
                        $num=count($elementi);
                    ?>
                    <li id="contatore">Elementi:  <?php echo $num; ?></li><br>
                    
                    <?php 
                    
                    foreach ($elementi as $elemento) {
                                    echo '<li class="element" id="element" hidden>' . $elemento->getNome() . '</li><br>';
                                    echo '<li class="element" id="element" hidden>Quant: ' . $elemento->getQuantita() . '</li><br><br>';
                                }
                    
                    ?>
                    
                </ul>   
            </nav>
            <?php
        }
    }
}
?>
