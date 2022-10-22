<?php

//to adapt

require_once("Post.php");

class Skill extends Post
{

    protected $tableName = "tbl_skill";


    public function New($title, $percentage,$careerEventID, $picture = null ,$dateStart = null, $dateEnd = null )
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {

                $activePercentage = $percentage == "-1" ? "0" : "1" ; 


          
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(title, fk_idSkillType, activationPercentage, Percentage) VALUES (" . $this->pdo->quote($title) . ", " . $this->pdo->quote($careerEventID) .",".$activePercentage.",".$this->pdo->quote($percentage).");" );
                $stmt = $stmt->execute();
                return true;
            }
        }
        return false;
    }

    // title is percentage 
    public function Edit($oldtitle,$title, $text, $dateStart = null, $dateEnd = null)
    {
        if ($this->CheckLengthTitle($title) && $text >= -1 && $text <= 100) {  

            $activePercentage = $text == "-1" ? "0" : "1" ; 
            if ( $oldtitle==$title || ($this->PostExists($oldtitle) and !$this->PostExists($title)) ) {
                $stmt = $this->pdo->prepare("UPDATE " . $this->tableName . " SET title = " . $this->pdo->quote($title) . ", activationPercentage = ".$this->pdo->quote($activePercentage).",Percentage = ".$this->pdo->quote($text)."  WHERE title = " . $this->pdo->quote($oldtitle) . ";");
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

    public function GetAllSkills($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE fk_idSkillType = ".$this->pdo->quote($id).";");
            $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }



    public function RemoveByID($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE fk_idSkillType = " . $this->pdo->quote($id) . "; ");
        $stmt->execute() ;
        return true ; 
    }

    public function IDtoTitle($id) {
        $stmt = $this->pdo->prepare("SELECT title FROM $this->tableName WHERE fk_idSkillType = " . $this->pdo->quote($id) . "; ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function GetAllAssociatedSkill($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_idSkillType = ".$this->pdo->quote($id)."; ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }







}
