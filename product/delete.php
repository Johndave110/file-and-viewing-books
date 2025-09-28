<?php
    require_once "../classes/Books.php";
    $booksObj = new Books();
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["id"])){
            $bid = trim(htmlspecialchars($_GET["id"]));
            $books = $booksObj->fetchBooks($bid);
            if(!$books){
                echo "<a href='viewbook.php'>View Product</a>";
                exit("No Books Found");
            }else{
            $booksObj->deleteBooks($bid);
            header("location: viewbook.php");
        }
        }else{
        echo "<a href='viewbook.php'>View Books</a>";
        exit("No product found");
    }
}
