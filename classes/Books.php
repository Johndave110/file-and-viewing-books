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
    public $genre_name = "";
    public $publication_date = "";

    public function getGenres(){
        $sql = "SELECT * FROM genre";
        $query = $this->db->connect()->prepare($sql);

        if($query->execute()){
            return $query->fetchAll();
        }else{
            return [];
        }
    }
    
    protected $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBooks(){
        $sql = "INSERT INTO books (title, author, genre_id, publication_date) VALUES (:title, :author, :genre_id, :publication_date)";

        $query = $this->db->connect()->prepare($sql);
        
        $query -> bindParam(":title", $this->title);
        $query -> bindParam(":author", $this->author);
        $query -> bindParam(":genre_id", $this->genre_name);
        $query -> bindParam(":publication_date", $this->publication_date);

        return $query->execute();
    }

    public function fetchBooks($bid){
        $sql = "SELECT b.book_id, b.title, b.author, g.genre_name, b.publication_date from books b inner join genre g on b.genre_id=g.genre_id where b.book_id = :bid";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":bid", $bid);

        if($query->execute()){
            return $query->fetch();
        }else{
            return null;
        }
    }

    public function viewBook(){
        $sql = "SELECT b.book_id, b.title, b.author, g.genre_name, b.publication_date from books b inner join genre g on b.genre_id=g.genre_id ORDER by book_id ASC";
        $query = $this->db->connect()->prepare($sql);
        if($query->execute()){
            return $query->fetchAll();
        }else{
            return null;
        }
    }

    public function isProductExist($title, $bid=""){
        $sql = "SELECT COUNT(*) as total FROM books WHERE title=:title and id <> :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $title);
        $query->bindParam(":id", $bid);
        $record = null;
        if($query->execute()){
            $record = $query->fetch();
        }

        if($record["total"] > 0){
            return true;
        }else{
            return false;
        }
    }

    
    

    public function editBook($bid){
        $sql = "UPDATE product set title=:title, author=:author, genre_id=:genre_id, publication_date=:publication_date WHERE id=:id";
        $query = $this->db->connect()->prepare($sql);
        
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre_id", $this->genre_name);
        $query->bindParam(":publication_date", $this->publication_date);
        $query->bindParam(":id", $bid);

        return $query->execute();
    }

    public function deleteBooks($bid){
        $sql = "DELETE FROM books where id=:id";

        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(":id", $bid);

        return $query->execute();
    }
}

// $obj = new product();
// $obj->name = "";
// $obj->price = "";

// var_dump($obj)->addProduct();
