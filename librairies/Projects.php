<?php

require_once("Post.php") ; 

class Projects extends Post {

    protected $tableName = "tbl_projects";

    protected $defaultText = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Porttitor rhoncus dolor purus non enim praesent elementum facilisis leo. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Diam quis enim lobortis scelerisque fermentum dui. Vehicula ipsum a arcu cursus vitae. Sit amet est placerat in egestas erat. Ut faucibus pulvinar elementum integer enim neque volutpat. Vitae ultricies leo integer malesuada nunc vel risus commodo. Consectetur a erat nam at lectus urna. In nulla posuere sollicitudin aliquam ultrices sagittis orci a. Dignissim convallis aenean et tortor at risus viverra adipiscing. Amet justo donec enim diam vulputate. Luctus venenatis lectus magna fringilla urna porttitor. Nulla aliquet porttitor lacus luctus accumsan tortor posuere.
    " ;




    public function New($title, $picture) {
        $stmt = $this->pdo->prepare("INSERT INTO ".$this->tableName."(title, photoName, fullTextOfProject) VALUES (" . $this->pdo->quote($title) . ", " . $this->pdo->quote($picture) . ", '".$this->defaultText."')"); ;
        $stmt = $stmt->execute();
    }


    public function Edit($title, $text) {

        $stmt = $this->pdo->prepare("UPDATE ".$this->tableName." SET title = " . $this->pdo->quote($title) . ", fullTextOfProject = " . $this->pdo->quote($text) . " WHERE title = " . $this->pdo->quote($title) . ";");
        $stmt->execute();
    }

    public function Remove($title) {

        if ( $this->PostExists($title)) {
            $stmt = $this->pdo->prepare("DELETE FROM ".$this->tableName." WHERE title = " . $this->pdo->quote($title) . " ; ");
            $stmt->execute();
            return true ; 
        }
        else {
            return false; 
        }
            
    }

    protected function GetPostNumber() {

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->tableName;") ;
        $stmt->execute() ;
        $res = $stmt->fetch()["COUNT(*)"] ; 

        return $res ; 
    }

    protected function PostExists($title) {

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

    public function GetAllPosts() {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultat;
    }

    public function GetPost($title) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE title=" . $this->pdo->quote($title) . " ;");
      $stmt->execute();
      $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resultat;

    }

    public function GetPostsNames() {
        $stmt = $this->pdo->prepare("SELECT title FROM $this->tableName ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultat;
    }

    


    
}