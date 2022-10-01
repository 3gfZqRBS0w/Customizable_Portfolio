<?php

require_once("Post.php") ; 

class Articles extends Post {
    protected $tableName = "tbl_articles";

    public function New($title, $picture = null) {

        if ($this->CheckLengthTitle($title)) {
        if (!$this->PostExists($title)) {
            $stmt = $this->pdo->prepare("INSERT INTO $this->tableName(title, publicationDate, fullTextOfArticles) VALUES(".$this->pdo->quote($title).", NOW(), '$this->defaultText');") ;
            $stmt->execute();
            return true ; 
        }
    }
            return false ; 
        
        

    }

    public function Edit($oldtitle, $title, $text) {
        if ($this->CheckLengthTitle($title)) {
        if (!$this->PostExists($title)) {
        $stmt = $this->pdo->prepare("UPDATE tbl_projects SET title = " . $this->pdo->quote($title) . ", fullTextOfProject = " . $this->pdo->quote($text) . " WHERE title = " . $this->pdo->quote($oldtitle) . ";") ;
        $stmt->execute();
        return true ;
        }
    }
        return false ; 
    }

    public function Remove($title) {
        if ($this->CheckLengthTitle($title)) {
        if ( $this->PostExists($title)) {
            $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . " ; ");
            $stmt->execute();
            return true ; 
        }
    }
    return false; 
    }

    public function GetAllPosts() {

    }

    public function GetPostsNames() {

    }

    public function GetPost($title) {
        
    }

    public function GetPostNumber() {

    }

    public function PostExists($title) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . ";") ;
        $stmt->execute();
        $res = $stmt->fetch()["COUNT(*)"] ; 

        if ( $res  == 1 ) {
            return true ;
        } 
        else {
            return false ; 
        }
    }



}