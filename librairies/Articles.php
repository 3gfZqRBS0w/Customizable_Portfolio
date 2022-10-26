<?php

require_once("Post.php");

class Articles extends Post
{

    protected $tableName = "tbl_articles";
    protected $logTable = "tbl_articlesLogs";

    public function New($title, $picture = null, $eventText = null, $dateStart = null, $dateEnd = null, $careerEventID = null)
    {

        if ($this->CheckLengthTitle($title)) {
            if (!$this->PostExists($title)) {
                $stmt = $this->pdo->prepare("INSERT INTO $this->tableName(title, publicationDate, fullTextOfArticles) VALUES(" . $this->pdo->quote($title) . ", NOW(), '$this->defaultText');");
                $stmt->execute();
                return true;
            }
        }
        return false;
    }

    public function Edit($oldtitle, $title, $text, $dateStart = null, $dateEnd = null)
    {
        if ($this->CheckLengthTitle($title)) {
            if ($oldtitle != $title) {
                $stmt = $this->pdo->prepare("UPDATE $this->tableName SET title = " . $this->pdo->quote($title) . ", fullTextOfArticles = " . $this->pdo->quote($text) . " WHERE title = " . $this->pdo->quote($oldtitle) . ";");
            }
            else {
                $stmt = $this->pdo->prepare("UPDATE $this->tableName SET fullTextOfArticles = " . $this->pdo->quote($text) . " WHERE title = " . $this->pdo->quote($oldtitle) . ";");

            }
                $stmt->execute();
                return true;
            
        }
        return false;
    }


}
