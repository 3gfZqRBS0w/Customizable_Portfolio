<?php

class Contact {

    public $tableName = 'tbl_contacts';
    
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function __destruct()
    {
        $this->pdo = null ;
    }


    public function  GetAllMessages()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function GetMessage($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = ".$this->pdo->quote($id)." ;");
        $stmt->execute() ;
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;

    }


private function IsValidPhoneNumber($phone){
    if(preg_match('/^[0-9]{10}+$/', $phone)) 
    {
        return true ; 
    } 
    else 
    {
        return false ; 
    }
}
    public function New($fullName, $email, $num, $object ,$message, $key) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && ($this->IsValidPhoneNumber($num))) {

            $stmt = $this->pdo->prepare("INSERT INTO ".$this->tableName."(fullName, email, num, title ,message, fk_logsID) VALUES(".$this->pdo->quote($fullName).",".$this->pdo->quote($email).",".$this->pdo->quote($num).",".$this->pdo->quote($object).",".$this->pdo->quote($message).", $key) ; ");
            $stmt->execute();
            return true ;
        }
        else {
            return false ; 
        }
    }


    public function TreatsMessage($IsValid, $id, $email,$data) {
        if ($IsValid) {
            mail($email, $data["title"], "Ce mail a été envoyé par ".$data["email"]."\n Son numéro est ".$data["num"]."\n Le message est :".$data["message"]) ;
        }
        $stmt = $this->pdo->prepare("DELETE FROM ".$this->tableName." WHERE id = $id ;") ;
        $stmt->execute();
    }
}