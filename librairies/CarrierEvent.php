<?php

//to adapt

require_once("Post.php");

class CarrierEvent extends Post
{

    protected $tableName = "tbl_carreersEvent";



    public function New($title,$eventText,$dateStart, $dateEnd, $careerEventID, $picture = null)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(title) VALUES (".$this->pdo->quote($title).") ; ");
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


    public function Edit($oldtitle,$title, $text)
    {
        if ($this->CheckLengthTitle($title)) {  
            if ( $oldtitle==$title || ($this->PostExists($oldtitle) and !$this->PostExists($title)) ) {
                $stmt = $this->pdo->prepare("UPDATE " . $this->tableName . " SET title = " . $this->pdo->quote($title) . ", fullTextOfProject = " . $this->pdo->quote($text) . " WHERE title = " . $this->pdo->quote($oldtitle) . ";");
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
                $imgName = $this->GetPictureName($title); 
                if (unlink(__DIR__ . "/../upload/$imgName")) {
                    $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . " ; ");
                    $stmt->execute();
                    return true;
                }
            }
        }
        return false;
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
