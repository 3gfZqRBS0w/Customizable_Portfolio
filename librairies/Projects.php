<?php

require_once("Post.php");

class Projects extends Post
{

    protected $tableName = "tbl_projects";


    public function New($title, $picture)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . "(title, photoName, fullTextOfProject) VALUES (" . $this->pdo->quote($title) . ", " . $this->pdo->quote($picture) . ", '" . $this->defaultText . "')");;
                $stmt = $stmt->execute();
                return true;
            }
        }
        return false;
    }


    public function Edit($oldtitle,$title, $text)
    {
        if ($this->CheckLengthTitle($title)) {
            if ($this->PostExists($oldtitle) and !$this->PostExists($title)) {
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

    private function GetPictureName($title)
    {
        return $this->GetPost($title)[0]["photoName"];
    }

    protected function GetPostNumber()
    {

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->tableName;");
        $stmt->execute();
        $res = $stmt->fetch()["COUNT(*)"];

        return $res;
    }

}