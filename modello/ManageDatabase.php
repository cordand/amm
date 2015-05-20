<?php

// db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "davide";

class ManageDatabase{
    var $mysqli;
    var $db,$msg;
    
    function __construct($db) {
       $this->$db=$db;
       $this->dbConnect($db);
        
    }

    function dbConnect($db = "") {
    global $dbhost, $dbuser, $dbpass;
    $this->mysqli = new mysqli();
    $this->mysqli->connect($dbhost, $dbuser,$dbpass, $db);
    if($this->mysqli->connect_errno != 0){
    // gestione errore
        $idErrore =  $this->mysqli->connect_errno;
        $this->msg = $this->mysqli->connect_error;
        error_log("Errore nella connessione al server $idErrore : $msg", 0);
        //echo "Errore nella connessione $msg";
        return false;
    }else {
    // nessun errore
    //11echo "Tutto ok";

        return true;
    }

}

private function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}



function getIndexItems($indice,$query){
    $query=urldecode($query);
    if(!$this->startsWith($query, "::")){
        
    if (!is_numeric($indice)) {
            return 0;
        }
        $query= htmlspecialchars($query);
    if ($indice == -1) {
        if(strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc limit 10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit 10";
            }
        } else if ($indice ==10) {
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc " . $indice . ",10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",10";
            }
        }
        else{
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE nome LIKE '%$query%' OR descrizione LIKE '%$query%' order by id desc limit " . $indice . ",20";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",20";
            }
        }
     //echo $sql;
    $result =  $this->mysqli->query($sql);
    }else{
        
    if (!is_numeric($indice)) {
            return 0;
        }
        
        $query=str_replace(":", "", $query);
    if ($indice == -1) {
        
        
        
        $query= htmlspecialchars($query);
        if(strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE inserzionista_id = $query  order by id desc limit 10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit 10";
            }
        } else if ($indice ==10) {
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE inserzionista_id = $query  order by id desc " . $indice . ",10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",10";
            }
        }
        else{
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE inserzionista_id = $query  order by id desc limit " . $indice . ",20";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items order by id desc limit " . $indice . ",20";
            }
        }
     
    $result =  $this->mysqli->query($sql);
    }
    
    return $result;
}

 

function close(){
    $this->mysqli->close();
}

function addItem($nome,$descrizione,$prezzo,$immagine,$inserzionista,$id,$emailinserzionista,$disponibili){
    $stmt = $this->mysqli->stmt_init();
    
    
    $sql = "INSERT INTO items SET
                                
                                nome = ?,
                                descrizione = ?,
                                prezzo = ?,        
                                immagine = ?,
                                inserzionista =?,
                                inserzionista_id =?,
                                emailinserzionista=?,
                                disponibili = ?";
    
    $stmt->prepare($sql);
    $stmt->bind_param("ssdssisi", $nome, $descrizione,$prezzo,$immagine,$inserzionista,$id,$emailinserzionista,$disponibili);
    if($stmt->execute()){
        $stmt->close();
        return true;
    
    }
    else {
        $stmt->close();
        return false;
    
    }
    
}

function sendMessage($id_m, $id_d,$id_p,$testo){
    $stmt = $this->mysqli->stmt_init();
    $this->mysqli->autocommit(FALSE);
    
    $sql = "INSERT INTO messaggi SET
                                
                                id_mittente = ?,
                                id_destinatario = ?,
                                id_prodotto = ?,        
                                testo = ?,
                                data =?";
    
    $stmt->prepare($sql);
    $stmt->bind_param("iiiss", $id_m, $id_d,$id_p,$testo,date(DATE_ATOM));
 
    if($stmt->execute()){
        $id=$stmt->insert_id;
        $this->mysqli->commit();
        $stmt->close();
        return $id;
    
    }
    else {
        error_log  ( "Execute failed: (" . $stmt->errno . ") " . $stmt->error,0);
        $this->mysqli->rollback();
        $stmt->close();
        return false;
    
    }
    
    
}

private function getProdName($id){
    $stmt = $this->mysqli->stmt_init(); 
    $sql= "SELECT nome FROM items WHERE id = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->bind_result($nome);
    $stmt->fetch();
    $stmt->close();
    return $nome;
}
 function getIdDetails($id){
    $stmt = $this->mysqli->stmt_init(); 
    $sql= "SELECT nome,cognome FROM users WHERE id = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->bind_result($nome,$cognome);
    $stmt->fetch();
    $stmt->close();
    
    return $nome." ".$cognome;
}

function removeItem($itemId,$sid){
    $stmt = $this->mysqli->stmt_init();
    $sql="DELETE FROM items WHERE id = ? AND inserzionista_id=?";
    $stmt->prepare($sql);
    $stmt->bind_param("ii", $itemId,$sid);
    if($stmt->execute()){
        
        $num = $stmt->affected_rows;
        $stmt->close();
        return $num;
    }else
    {
        return -1;
    }
    
    
}

function countMessagesById($id){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT COUNT(*) FROM messaggi WHERE id_mittente = ? OR id_destinatario=? AND cancellato=0";
    
    $stmt->prepare($sql);
    $stmt->bind_param("ii", $id,$id);
    //$stmt->store_result();
    if($stmt->execute()){
        $stmt->bind_result($num);
        $stmt->fetch();
        $stmt->close();
        return $num;
   
    }else{
        
        $stmt->close();
        return 0;
    }
    
    
    
}

function getMessagesById($id,$indice){
//    $stmt = $this->mysqli->stmt_init(); 
    $indice*=20;
    $sql= mysql_real_escape_string("SELECT id_prodotto,id_destinatario,id_mittente,letto,testo,data,id FROM messaggi WHERE (id_mittente=$id OR id_destinatario=$id) AND cancellato=0  order by id desc limit $indice,20");
//    $stmt->prepare($sql);
//    $stmt->bind_param("ii", $id,$indice);
//    if(!$stmt->execute()){
//        $stmt->close();
//        return false;
//    }
//    $stmt->bind_result($id_prodotto,$id_destinatario,$letto,$testo);
    
    $result =  $this->mysqli->query($sql);
    if(!$result){
        return false;
    }
    
    $arrDest=array();
    $arrProd=array();
    $arrMit=array();
    $a  = array();
    
    while (($row = $result->fetch_array())) {
       // echo "COUNT ".var_dump($row);
        if(!isset($arrProd[$row[0]])){
            $arrProd[$row[0]]=$this->getProdName($row[0]);
        }
        if(!isset($arrDest[$row[1]])){
            $arrDest[$row[1]]=$this->getIdDetails($row[1]);
        }
        if(!isset($arrMit[$row[2]])){
            $arrMit[$row[2]]=$this->getIdDetails($row[2]);
        }
        
        $temp = new MessaggioClass();
        $temp->setNomeP($arrProd[$row[0]]);
        $temp->setNomeD($arrDest[$row[1]]);
        $temp->setNomeM($arrMit[$row[2]]);
        $temp->setTesto($row[4]);
        $temp->setLetto($row[3]);
        $temp->setData($row[5]);
        $temp->setIdMessaggio($row[6]);
        $a[]=$temp;
    }
    //$stmt->close();
    return $a;
    
}

function getMessaggioById($id,$sid){
    $stmt = $this->mysqli->stmt_init();
    $sql= ("SELECT id_prodotto,id_destinatario,id_mittente,letto,testo,data,id FROM messaggi WHERE id=? AND (id_mittente=? OR id_destinatario=?) AND cancellato=0");
    $stmt->prepare($sql);
    $stmt->bind_param("iii", $id,$sid,$sid);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->bind_result($id_prodotto,$id_destinatario,$id_mittente,$letto,$testo,$data,$id);
    
    if($stmt->fetch()){
        $stmt->close();
        $temp= new MessaggioClass();
        $temp->setIdDestinatario($id_destinatario);
        $temp->setNomeP($this->getProdName($id_prodotto));
        $temp->setNomeD($this->getIdDetails($id_destinatario));
        $temp->setNomeM($this->getIdDetails($id_mittente));
        $temp->setTesto($testo);
        $temp->setLetto($letto);
        $temp->setData($data);
        $temp->setIdMessaggio($id);
        $temp->setIdProdotto($id_prodotto);
        $temp->setIdMittente($id_mittente);
        return $temp;
    }
    
    $stmt->close();
    return false;
    
    
}
function setLetto($id,$sid){
    $stmt = $this->mysqli->stmt_init();
    
    $sql= ("UPDATE messaggi SET letto =  '1' WHERE id=? AND (id_mittente=? OR id_destinatario=?) AND cancellato=0");
    $stmt->prepare($sql);
    $stmt->bind_param("iii", $id,$sid,$sid);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->close();
    return true;
}
function getId($nome,$descrizione,$prezzo,$mail){
    $stmt = $this->mysqli->stmt_init();
    $sql= "SELECT id FROM items WHERE nome=? AND
                                        descrizione=? AND
                                        prezzo=? AND
                                        emailinserzionista=?";
    $stmt->prepare($sql);
    $stmt->bind_param("ssds", $nome, $descrizione,$prezzo,$mail);
    
// collego i risultati della query con un insieme di variabili
   

  
    
    if(!$stmt->execute()){
        $stmt->close();
        return -1;
    }
    $stmt->bind_result($resid);
    $stmt->fetch();
    if (count($resid) == 1) { 
        $stmt->close();    
        return $resid;
    }
    $stmt->close();
    return -1;
}

function logIn($email,$password)
{
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT nome,cognome,id,tipo FROM users WHERE email = ? AND password=PASSWORD(?)";
    $stmt->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->bind_result($nome,$cognome,$id,$tipo);
    $a  = array();
    while ($stmt->fetch()) {
        $a[]=$nome;
        $a[]=$cognome;
        $a[]=$id;
        $a[]=$tipo;
    }
    $stmt->close();
    return $a;
}

function userDetails($email)
{
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT nome,cognome,email,tipo FROM users WHERE email = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("s", $email);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->bind_result($nome,$cognome,$email,$tipo);
    
    $a  = array();
    while ($stmt->fetch()) {
        $a[]=$nome;
        $a[]=$cognome;
        $a[]=$email;
        $a[]=$tipo;
    }
    if(count($a)==4){
        $stmt->close();
        return $a;
    }
    $stmt->close();
    return null;
}

function getEmailAvailability($email){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("s", $email);

       
    
    if($stmt->execute()){
         $stmt->bind_result($num);
        $stmt->fetch();
        $stmt->close();
        
        if($num > 0)
    {
            
        return 0;
    }
    else{
        
        return 1;
    }
    }else{
        $stmt->close();
        return -1;
    }
    
    
}

function createAccount($value,$password){
    $stmt = $this->mysqli->stmt_init();
    $sql = "INSERT INTO users SET
                    tipo = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    password = PASSWORD(?),
                    via = ?,   
                    citta = ?,  
                    sesso = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("issssssi", $value->getTipo(),$value->getNome(),$value->getCognome(),$value->getEmail(),$password,$value->getVia(),$value->getCitta(),$value->getSesso());
    if($stmt->execute()){
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;

}


function getNumeroInserzioni($id){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT COUNT(*) FROM items WHERE inserzionista_id = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if( $stmt->execute()){
        $stmt->bind_result($gNumb);
        $stmt->fetch();
        $stmt->close();
        return $gNumb;
    }else{
        $stmt->close();
        return 0;
    }
    
}

function getItem($id){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT nome,descrizione,immagine,disponibili,prezzo,inserzionista_id FROM items WHERE id = ?";
    
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->bind_result($nome,$descrizione,$immagine,$disponibili,$prezzo,$inserzionista);
    
    $a=array();
    $stmt->store_result();
    
    
    if ($stmt->num_rows == 1) {
        $stmt->fetch();
        $a[]=$nome;
        $a[]=$descrizione;
        $a[]=$immagine;
        $a[]=$disponibili;
        $a[]=$prezzo;
        $a[]=$inserzionista;
        $stmt->close();
        return $a;
    } else {
        $stmt->close();
        return false;
    }
}

function getItemInserzionista($id){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT inserzionista_id FROM items WHERE id = ?";
    
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->bind_result($id);
    
    $a=array();
    $stmt->store_result();
    
    
    if ($stmt->num_rows == 1) {
        $stmt->fetch();
        $stmt->close();
        return $id;
    } else {
        $stmt->close();
        return false;
    }
}


function restoreLoginDb($id,$token){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT nome,cognome,email,tipo,id,remember FROM users WHERE id = ? AND remember LIKE ?";
    $stmt->prepare($sql);
    $param = "%{$token}%";
    $stmt->bind_param("is", $id,$param);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->bind_result($nome,$cognome,$email,$tipo,$id,$token);
    //echo "WEEEE";
    $a  = array();
    while ($stmt->fetch()) {
        $a[]=$nome;
        $a[]=$cognome;
        $a[]=$email;
        $a[]=$tipo;
        $a[]=$id;
        $a[]=$token;
    }
    if(count($a)==6){
        $stmt->close();
        return $a;
    }
    $stmt->close();
    return false;
}
 
function updateToken($id,$email,$tokenOld,$remember){
            
            $token = md5(date(DATE_ATOM));
            if(strlen($tokenOld)>0)
                $rem= str_replace($tokenOld, $token, $remember);
            else{
                $rem=$remember.";".$token;
            }
            $stmt = $this->mysqli->stmt_init();
            $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = ? WHERE email = ?");
            $stmt->prepare($sql);
            $stmt->bind_param("ss", $rem,$email);
            
            
            setcookie("n", $id, time() + 2592000);
            setcookie("t", $token, time() + 2592000);
            $stmt->execute();
            $stmt->close();
}

function updateUltimoAccesso($email){
     $stmt = $this->mysqli->stmt_init();
     $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '' WHERE email = ?");
     $stmt->prepare($sql);
     $stmt->bind_param("s", $email);
     $stmt->execute();
    
}

}

?>

