<?php


require_once("Post.php");

class CarrierType extends Post
{

    protected $tableName = "tbl_careers";


    public function New($title, $picture = null,$eventText = null,$dateStart = null, $dateEnd = null, $careerEventID = null)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(title) VALUES (".$this->pdo->quote($title).") ; ");
                $stmt = $stmt->execute();
                return true;
            }
        } 
        return false;
    }


    public function Edit($oldtitle,$title, $text, $dateStart = null, $dateEnd = null)
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

    public function GetCarrierTypeIDByTitle($title) { 
        $stmt = $this->pdo->prepare("SELECT id FROM $this->tableName WHERE title = ".$this->pdo->quote($title).";");
        $stmt->execute();
        $res = $stmt->fetch()["id"] ; 
        return $res ;
 
    }




    private function GetPictureName($title)
    {
        return $this->GetPost($title)[0]["photoName"];
    }

}