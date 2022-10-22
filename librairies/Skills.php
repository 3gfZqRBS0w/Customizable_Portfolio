<?php

//to adapt

require_once("Post.php");

class Skills extends Post
{

    protected $tableName = "tbl_skillType" ;
    protected $skill ; 

    function __construct($pdo) {
        $this->pdo = $pdo ;
        $this->skill = new Skill($pdo) ; 
    }


    public function New($title, $picture = null ,$dateStart = null, $dateEnd = null, $careerEventID = null, $percentage = null)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(title) VALUES (" . $this->pdo->quote($title).") ; ");;
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
                $stmt = $this->pdo->prepare("UPDATE " . $this->tableName . " SET title = " . $this->pdo->quote($title) ." WHERE title = " . $this->pdo->quote($oldtitle) . ";");
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
                if ($this->skill->RemoveByID($this->GetSkillTypeIDByTitle($title))) {
                    $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . " ; ");
                    $stmt->execute();
                    return true;
                }
            }
        }
        return false;
    }


    public function GetSkillTypeIDByTitle($title) { 
        $stmt = $this->pdo->prepare("SELECT id FROM $this->tableName WHERE title = ".$this->pdo->quote($title).";");
        $stmt->execute();
        $res = $stmt->fetch()["id"] ; 
        return $res ;
 
    }

    public function GetSkills() {
        return $this->skill ; 
    }

}
