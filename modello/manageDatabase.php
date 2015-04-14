<?php

// db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "davide";

function dbConnect($db = "") {
    global $dbhost, $dbuser, $dbpass;
    
    $dbcn = @mysql_connect($dbhost, $dbuser, $dbpass)
            or die("The site database appears to be down.");

   
    
    if ($db != "" and ! @mysql_select_db($db))
        die("The site database is unavailable.");

    return $dbcn;
}


function getIndexItems(){
    $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit 20";
    $result = mysql_query($sql);
    return $result;
}

function addItem($nome,$descrizione,$prezzo,$immagine,$inserzionista,$emailinserzionista,$disponibili){
    $sql = "INSERT INTO items SET
                                
                                nome = '$nome',
                                descrizione = '$descrizione',
                                prezzo = $prezzo,        
                                immagine = '$immagine',
                                inserzionista ='$inserzionista',
                                emailinserzionista='$emailinserzionista',
                                disponibili = '$disponibili'";
    return mysql_query($sql);
}

function getId($nome,$descrizione,$prezzo,$mail){
    $sql= "SELECT id FROM items WHERE nome='$nome' AND
                                        descrizione='$descrizione' AND
                                        prezzo='$prezzo' AND
                                        emailinserzionista='$mail'";
    $result=mysql_query($sql);
    if(!$result){
        return -1;
    }
    $data = mysql_num_rows($result);
    if ($data == 1) { 
        $data = mysql_fetch_row($result);
        return $data[0];
    }
    return -1;
}

function logIn($email,$password)
{
    $sql = "SELECT nome,cognome,numero,tipo FROM users WHERE email = '" . $email . "' AND password=PASSWORD('" . $password . "')";
            return mysql_query($sql);
}

function userDetails($email)
{
    $sql = "SELECT nome,cognome,email,tipo FROM users WHERE email = '" . $email . "'";
    $result=mysql_query($sql);
    if(!$result){
        return -1;
    }
    $data = mysql_num_rows($result);
    $ret = array();
    if ($data == 1) { 
        $data = mysql_fetch_row($result);
        return $data;
    }
    return null;
}

function getEmailAvailability($email){
    $sql = "SELECT COUNT(*) FROM users WHERE email = '" . $email . "'";
    
    $result=mysql_query($sql);
    if (!$result){
        return -1;
    }
    if(mysql_result($result, 0, 0) > 0)
    {
        return 0;
    }
    else{
        return 1;
    }
    
}

function createAccount($tipo,$nome,$cognome,$email,$password,$sesso){
    $sql = "INSERT INTO users SET
                    tipo = '$tipo',
                    nome = '$nome',
                    cognome = '$cognome',
                    email = '$email',        
                    password = PASSWORD('$password'),
                    sesso = '$sesso'";
    return mysql_query($sql);
}


function getNumeroInserzioni($email){
    $sql = "SELECT COUNT(*) FROM items WHERE emailinserzionista = '" . $email . "'";
    
    $result=mysql_query($sql);
    if (!$result){
        return 0;
    }
    return mysql_result($result, 0, 0);
    
}

function getItem($id){
    $sql = "SELECT nome,descrizione,immagine,disponibili,prezzo FROM items WHERE id = '" . $id . "'";
    $result = mysql_query($sql);
    $data = mysql_num_rows($result);
    if ($data == 1) {
        return mysql_fetch_row($result);
    } else {
        return false;
    }
}

?>

