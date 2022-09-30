<?php

abstract class Post {

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function __destruct()
    {
        $this->pdo = null ;
    }

    abstract public function New($title, $picture) ;
    abstract public function Remove($title) ;
    abstract public function Edit($title, $text) ;

    abstract public function GetAllPosts() ;
    abstract public function GetPostsNames() ;
    abstract public function GetPost($title) ;

    // abstract method
    abstract protected function GetPostNumber() ; 
    abstract protected function PostExists($title) ;



    
    
    
}