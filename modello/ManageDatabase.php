<?php

// db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "davide";

class ManageDatabase{

    function __construct($db) {
        $this->dbConnect($db);
        
    }

    function dbConnect($db = "") {
    global $dbhost, $dbuser, $dbpass;
    
    $dbcn = @mysql_connect($dbhost, $dbuser, $dbpass)
            or die("The site database appears to be down.");

   
    
    if ($db != "" and ! @mysql_select_db($db))
        die("The site database is unavailable.");

    return $dbcn;
}


function getIndexItems($indice,$query){
    if(!is_numeric($indice))
        return 0;
    $query=  htmlspecialchars($query);
    if ($indice == -1) {
            if(strlen($query)>0){
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc limit 10";
            }else
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit 10";
        } else if ($indice ==10) {
            if(strlen($query)>0){
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc " . $indice . ",10";
            }else
            $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",10";
            
        }
        else{
            if(strlen($query)>0){
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc limit " . $indice . ",20";
            }else
            $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",20";
        }
     //echo $sql;
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

function createAccount($value,$password){
    $sql = "INSERT INTO users SET
                    tipo = '".$value->getTipo()."',
                    nome = '".$value->getNome()."',
                    cognome = '".$value->getCognome()."',
                    email = '".$value->getEmail()."',        
                    password = PASSWORD('$password'),
                    via = '".$value->getVia()."',    
                    citta = '".$value->getCitta()."',    
                    sesso = '".$value->getSesso()."'";
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
function restoreLoginDb($id,$token){
    $sql = "SELECT nome,cognome,email,tipo FROM users WHERE numero = '" . $id . "' AND remember='" . $token . "'";
    $result = mysql_query($sql);
    return $result;
}
function updateToken($email){
    $token = md5(DATE_ATOM);
            $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '" . $token . "' WHERE email = '" . $data[2] . "'");
            setcookie("n", $id, time() + 2592000);
            setcookie("t", $token, time() + 2592000);
            mysql_query($sql);
}

}

?>

