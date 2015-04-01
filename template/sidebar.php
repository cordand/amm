<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printSidebar($loggato, $tipo, $email) {
    if (!$loggato) {
        ?>
        <nav id="sidebar">
            <h3><a href="carrello.php">Carrello</a></h3>
            <ul>
                <li id="contatore">Elementi: <?php echo 0; ?></li>
            </ul>   
        </nav>
        <?php
    } else {
        if ($tipo) {
            ?>
            <nav id="sidebar">
                <h3><a href="vetrina.php">Vetrina</a></h3>
                <ul>
                    <li id="contatore">Elementi:  <?php echo getNumeroInserzioni($email); ?></li>
                </ul>   
            </nav>
            <?php
        } else {
            if(session_status()!=PHP_SESSION_ACTIVE)
                session_start();
            ?>
            <nav id="sidebar">
                <h3><a href="carrello.php">Carrello</a></h3>
                <ul>
                    <li id="contatore">Elementi:  <?php echo count($_SESSION['carrello']->getElementi()); ?></li>
                </ul>   
            </nav>
            <?php
        }
    }
}
?>
