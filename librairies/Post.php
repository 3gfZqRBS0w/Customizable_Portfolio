<?php

abstract class Post {
    protected $pdo ; 

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function __destruct()
    {
        $this->pdo = null ;
    }

    protected $defaultText = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Porttitor rhoncus dolor purus non enim praesent elementum facilisis leo. Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Diam quis enim lobortis scelerisque fermentum dui. Vehicula ipsum a arcu cursus vitae. Sit amet est placerat in egestas erat. Ut faucibus pulvinar elementum integer enim neque volutpat. Vitae ultricies leo integer malesuada nunc vel risus commodo. Consectetur a erat nam at lectus urna. In nulla posuere sollicitudin aliquam ultrices sagittis orci a. Dignissim convallis aenean et tortor at risus viverra adipiscing. Amet justo donec enim diam vulputate. Luctus venenatis lectus magna fringilla urna porttitor. Nulla aliquet porttitor lacus luctus accumsan tortor posuere.
    " ;

    abstract public function New($title, $picture) ;
    abstract public function Remove($title) ;
    abstract public function Edit($oldtitle, $title, $text) ;
    abstract protected function GetPostNumber() ; 

    protected function PostExists($title)
    {

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $this->tableName WHERE title = " . $this->pdo->quote($title) . ";");
        $stmt->execute();
        $res = $stmt->fetch()["COUNT(*)"];

        if ($res  == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function GetPostsNames()
    {
        $stmt = $this->pdo->prepare("SELECT title FROM $this->tableName ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }



    public function  GetAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ;");
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function GetPost($title)
    {
        if ($this->CheckLengthTitle($title)) {
            $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE title=" . $this->pdo->quote($title) . " ;");
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        }
        return array();
    }



    protected function CheckLengthTitle($title) {
        if ( strlen($title) > 0 && strlen($title) < 32 ) {
            return true ;
        }
        else {
            return false ; 
        } 
    }

}