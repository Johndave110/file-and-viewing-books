<?php

// include
//include_once
// require
// require_once


require_once "database.php";

class Books{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_date = "";
    
    protected $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBooks(){
        $sql = "INSERT INTO books (title, author, genre, publication_date) VALUES (:title, :author, :genre, :publication_date)";
        $query = $this->db->connect()->prepare($sql);
        $query -> bindParam(":title", $this->title);
        $query -> bindParam(":author", $this->author);
        $query -> bindParam(":genre", $this->genre);
        $query -> bindParam(":publication_date", $this->publication_date);

        return $query->execute();
    }


    public function viewBook(){
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);

        if($query->execute()){
            return $query->fetchAll();
        }else{
            return null;
        }
    }
}

// $obj = new product();
// $obj->name = "";
// $obj->price = "";

// var_dump($obj)->addProduct();
