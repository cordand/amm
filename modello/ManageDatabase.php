<?php


// db.php

$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "davide";

$dbuser = "cordaAndrea";
$dbpass = "falco4603";



/*
 * Classe che gestisce tutte le operazioni che avvengono col database
 */

class ManageDatabase{
    
    var $mysqli;
    var $db,$msg;
    /**
     * Crea l'oggetto database
     * @param type $db
     */
    
    function __construct($db) {
       $this->$db=$db;
       $this->dbConnect($db);
        
    }
    /**
     * Esegue la connessione col database
     * @global string $dbhost
     * @global string $dbuser
     * @global string $dbpass
     * @param type $db
     * @return boolean
     */
    function dbConnect($db = "") {
        error_reporting(0);
    global $dbhost, $dbuser, $dbpass;
    //server pubblico
    $db="amm15_cordaAndrea";
    //server locale
    
    $this->mysqli = new mysqli();
    $this->mysqli->connect($dbhost, $dbuser,$dbpass, $db);
    if($this->mysqli->connect_errno != 0){
    // gestione errore
        $idErrore =  $this->mysqli->connect_errno;
        $this->msg = $this->mysqli->connect_error;
        error_log("Errore nella connessione al server $idErrore : $this->msg", 0);
        echo "Errore nella connessione";
        
        return false;
    }else {
    // nessun errore
    //11echo "Tutto ok";

        return true;
    }

}

/**
 * Chiude la connessione col database
 */
function close(){
    $this->mysqli->close();
}


/**
 * Controlla se una stringa inizia con una particolare sottostringa
 * @param type $haystack
 * @param type $needle
 * @return type
 */

private function startsWith($haystack, $needle) {
    
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}


/**
 * Restituisce gli elementi sulla base dell'anzianità e eventualmente di una stringa di ricerca
 * @param type $indice Indice della pagina
 * @param type $query Stringa di ricerca
 * @return int
 */

function getIndexItems($indice,$query){
    $query=urldecode($query);
    if(!$this->startsWith($query, "::")){
        
    if (!is_numeric($indice)) {
            return 0;
        }
        $query= htmlspecialchars($query);
    if ($indice == -1) {
        if(strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE (nome LIKE '%$query%' OR descrizione LIKE '%$query%') AND disponibili > 0 order by id desc limit 10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE disponibili > 0 order by id desc limit 10";
            }
        } else if ($indice ==10) {
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE (nome LIKE '%$query%' OR descrizione LIKE '%$query%') AND disponibili > 0 order by id desc " . $indice . ",10";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE disponibili > 0 order by id desc limit " . $indice . ",10";
            }
        }
        else{
            if (strlen($query) > 0) {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE (nome LIKE '%$query%' OR descrizione LIKE '%$query%') AND disponibili > 0 order by id desc limit " . $indice . ",20";
            } else {
                $sql = "SELECT id,nome,descrizione,immagine,prezzo FROM items WHERE disponibili > 0 order by id desc limit " . $indice . ",20";
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

 
/**
 * Aggiunge un nuovo elemento 
 * @param type $nome Nome dell'elemento
 * @param type $descrizione Descrizione
 * @param type $prezzo  Prezzo
 * @param type $immagine    Immagine da visualizzare
 * @param type $inserzionista   Inserzionista
 * @param type $id  Id di chi effettua l'inserzione
 * @param type $emailinserzionista  Email dell'inserzionista
 * @param type $disponibili Disponibilità del prodotto
 * @return boolean
 */

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
/**
 * Manda un messaggio al destinatario designato
 * @param type $id_m Id del mittente
 * @param type $id_d    Id del Destinatario
 * @param type $id_p    Id del prodotto di riferimento
 * @param type $testo   Testo del messaggio
 * @return boolean
 */
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
/**
 * Ritorna il nome di un prodotto e la sua disponibilita dato l'id
 * @param type $id Id del prodotto
 * @return array
 */
private function getProdName($id){
    $stmt = $this->mysqli->stmt_init(); 
    $sql= "SELECT nome,disponibili FROM items WHERE id = ?";
    $stmt->prepare($sql);
    $stmt->bind_param("i", $id);
    if(!$stmt->execute()){
        $stmt->close();
        return false;
    }
    $stmt->bind_result($nome,$disponibili);
    $stmt->fetch();
    $stmt->close();
    $a = array();
    $a[]=$nome;
    $a[]=$disponibili;
    return $a;
}
/**
 * Restituisce nome e cognome di un utente dato l'id
 * @param type $id Id dell'utente
 * @return boolean
 */


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
/**
 * Rimuove un elemento settando la disponibilità a 0
 * @param type $itemId id dell'oggetto da rimuovere
 * @param type $sid id del proprietario
 * @return type
 */
function removeItem($itemId,$sid){
    $stmt = $this->mysqli->stmt_init();
    $sql="UPDATE items SET disponibili=0 WHERE id = ? AND inserzionista_id=?";
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
/**
 * Conta i messaggi relativi a un certo utente
 * @param type $id Id dell'utente
 * @return int
 */

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


/**
 * Restituisce 20 messaggi per volta di un utente 
 * @param type $id id dell'utente
 * @param int $indice   indice della pagine
 * @param type $nomeUtente  nome utente di chi esegue la chiamata di funzione
 * @return \MessaggioClass|boolean Un array di messaggi
 */
function getMessagesById($id,$indice,$nomeUtente){
//    $stmt = $this->mysqli->stmt_init(); 
    $indice*=20;
    $sql= mysql_real_escape_string("SELECT messaggi.id_prodotto,"
            . "messaggi.id_destinatario,"
            . "messaggi.id_mittente,"
            . "messaggi.letto,"
            . "messaggi.testo,"
            . "messaggi.data,"
            . "messaggi.id,"
            . "users.nome,"
            . "users.cognome,"
            . "items.nome,"
            . "items.disponibili FROM messaggi JOIN users ON (messaggi.id_mittente!= $id AND users.id=messaggi.id_mittente ) OR  (messaggi.id_destinatario!= $id AND users.id=messaggi.id_destinatario) JOIN items ON items.id=messaggi.id_prodotto WHERE (id_mittente=$id OR id_destinatario=$id) AND cancellato=0  order by id desc limit $indice,20");

    
    
    $result =  $this->mysqli->query($sql);
    if(!$result){
        
        return false;
    }
    

    $a  = array();
    
    while (($row = $result->fetch_array())) {
  
        $temp = new MessaggioClass();

        $temp->setTesto($row[4]);
        $temp->setLetto($row[3]);
        $temp->setData($row[5]);
        $temp->setIdMessaggio($row[6]);
        if($row[1]==$id){
            $temp->setNomeD($nomeUtente);
        }else{
             $temp->setNomeD($row[7]." ".$row[8]);
        }
        if($row[2]==$id){
            $temp->setNomeM($nomeUtente);
        }else{
             $temp->setNomeM($row[7]." ".$row[8]);
        }
        $temp->setNomeP($row[9]);
        $temp->setDisponibili($row[10]);
        //$temp->setNomeM(if());
        $a[]=$temp;
    }
    //$stmt->close();
    return $a;
    
}
/**
 * Restituisce i dettagli relativi a un messaggio
 * @param type $id  Id del messaggio
 * @param type $sid Id dell'utente
 * @return boolean|\MessaggioClass
 */
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
        $prod = $this->getProdName($id_prodotto);
        $temp->setNomeP($prod[0]);
        $temp->setDisponibili($prod[1]);
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

/**
 * Cambia lo stato del messaggio da non letto a letto
 * @param type $id  Id del messaggio
 * @param type $sid Id del lettore
 * @return boolean
 */
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
/**
 * Restituisce l'id di un elemento dati dei parametri
 * @param type $nome    Nome del prodotto
 * @param type $descrizione Descrizione
 * @param type $prezzo  Prezzo
 * @param type $mail    Email dell'inserzionista
 * @return type
 */
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

/**
 * Esegue il login
 * @param type $email
 * @param type $password
 * @return boolean
 */
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
/**
 * REstituisce i dettagli di un utente data la sua email
 * @param type $email
 * @return boolean
 */
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
/**
 * Controlla la disponibilità di una certa email
 * @param type $email
 * @return int
 */
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

/**
 * Crea un nuovo account
 * @param type $value Oggetto di tipo UserReg che contiene i dettagli dell'utente
 * @param type $password    Password scelta
 * @return boolean
 */
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

/**
 * Ritorna il numero di inserzioni attive per un utente
 * @param type $id
 * @return int
 */
function getNumeroInserzioni($id){
    $stmt = $this->mysqli->stmt_init();
    $sql = "SELECT COUNT(*) FROM items WHERE inserzionista_id = ? AND disponibili>0";
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
/**
 * Restituisce i dettagli di un prodotto
 * @param type $id
 * @return boolean
 */
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
/**
 * Restituisce l'id di chi ha effetuato l'inserzione
 * @param type $id
 * @return boolean
 */
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

/**
 * Ripristina il login tramite l'id e il token contenuto nel cookie
 * @param type $id
 * @param type $token
 * @return boolean
 */
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
 /**
  * Aggiorna il token per il ripristino del login
  * @param type $id
  * @param type $email
  * @param type $tokenOld
  * @param type $remember
  */
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
/**
 * Aggiorna la data dell'ultimo accesso
 * @param type $email
 */
function updateUltimoAccesso($email){
     $stmt = $this->mysqli->stmt_init();
     $sql = ("UPDATE users SET ultimo_accesso = NOW(), remember = '' WHERE email = ?");
     $stmt->prepare($sql);
     $stmt->bind_param("s", $email);
     $stmt->execute();
    
}

}

?>

