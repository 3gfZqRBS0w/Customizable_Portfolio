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
    abstract public function GetAllPosts() ;
    abstract public function GetPostsNames() ;
    abstract public function GetPost($title) ;
    abstract protected function GetPostNumber() ; 
    abstract protected function PostExists($title) ;

    protected function CheckLengthTitle($title) {
        if ( strlen($title) > 0 && strlen($title) < 32 ) {
            return true ;
        }
        else {
            return false ; 
        } 
    }

}