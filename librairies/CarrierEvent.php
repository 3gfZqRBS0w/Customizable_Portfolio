<?php

//to adapt

require_once("Post.php");

class CarrierEvent extends Post
{

    protected $tableName = "tbl_carreersEvent";



    public function New($title,$dateStart, $dateEnd, $careerEventID, $picture = null)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(eventText, title, startDate, endDate, fk_idCareer) VALUES (".$this->pdo->quote($this->defaultText).",".$this->pdo->quote($title).", ".$this->pdo->quote($dateStart).",".$this->pdo->quote($dateEnd).", ".$this->pdo->quote($careerEventID)." ) ; ");
               $stmt->execute();
                return true;
            }
        } 
        return false;
    }

    public function GetAllCarrierEvents($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE fk_idCareer = ".$this->pdo->quote($id).";");
            $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function Edit($oldtitle,$title, $text, $dateStart, $dateEnd )
    {
        if ($this->CheckLengthTitle($title)) {  
            if ( $oldtitle==$title || ($this->PostExists($oldtitle) and !$this->PostExists($title)) ) {
                $stmt = $this->pdo->prepare("UPDATE " . $this->tableName . " SET title = " . $this->pdo->quote($title) . ", eventText = " . $this->pdo->quote($text) . ",startDate = ".$this->pdo->quote($dateStart).", endDate = ".$this->pdo->quote($dateEnd)." WHERE title = " . $this->pdo->quote($oldtitle) . ";");
                $stmt->execute();
                return true;
            }
        }

        return false;
    }

    public function Remove($title)
    {
        if ($this->CheckLengthTitle($title)) {
            if ($this->PostExists($title)) {
                    $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . " ; ");
                    $stmt->execute();
                    return true;
            }
        }
        return false;
    }

    public function RemoveByID($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE fk_idCareer = " . $this->pdo->quote($id) . "; ");
        $stmt->execute() ;
        return true ; 
    }

    public function IDtoTitle($id) {
        $stmt = $this->pdo->prepare("SELECT title FROM $this->tableName WHERE fk_idCareer = " . $this->pdo->quote($id) . "; ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function GetAllCareerEvent($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_idCareer = ".$this->pdo->quote($id)."; ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    private function GetPictureName($title)
    {
        return $this->GetPost($title)[0]["photoName"];
    }
}
