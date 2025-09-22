<?php
    require_once "../classes/Books.php";

    $books = ["title"=>"", "author"=>"", "genre"=>"", "publication_date"=>""];
    $errors = ["title"=>"", "author"=>"", "genre"=>"", "publication_date"=>"" ];


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $books["title"] = trim(htmlspecialchars($_POST["title"]));
        if(empty($books["title"])){
            $errors["title"] = "Please put the book title";
        }
        $books["author"] = trim(htmlspecialchars($_POST["author"]));
        if(empty($books["author"])){
            $errors["author"] = "Please put the Author name";
        }
        $books["genre"] = trim(htmlspecialchars($_POST["genre"]));
        if(empty($books["genre"])){
            $errors["genre"] = "Please Select a Genre";
        }
        $books["publication_date"] = trim(htmlspecialchars($_POST["publication_date"]));
        if(empty($books["publication_date"])){
            $errors["publication_date"] = "Please put a Publication Date";
        }

        if(empty(array_filter($errors))){
            $booksObj = new Books();
            $booksObj->title = $books["title"];
            $booksObj->author = $books["author"];
            $booksObj->genre = $books["genre"];
            $booksObj->publication_date = $books["publication_date"];

            if($booksObj->addBooks()){
                echo "success";
                $books = ["title"=>"", "author"=>"", "genre"=>"", "publication_date"=>""];
            }else{
                echo "failed";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Library Inventory</h1>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($books["title"]) ?>"><br>
        <p><?= $errors["title"] ?></p>

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($books["author"]) ?>"><br>
        <p><?= $errors["author"] ?></p>

        <label for="genre">Genre:</label>
        <select name="genre" id="">
            <option value="">--select genre--</option>
            <option value="history" <?= $books["genre"]=="history"?"selected":"" ?>>History</option>
            <option value="science" <?= $books["genre"]=="science"?"selected":"" ?>>Science</option>
            <option value="fiction" <?= $books["genre"]=="fiction"?"selected":"" ?>>Fiction</option>
        </select><br>
        <p><?= $errors["genre"] ?></p>

        <label for="publication_date">Publication Date:</label><br>
        <input type="date" name="publication_date" value="<?= htmlspecialchars($books["publication_date"]) ?>"><br>
        <p><?= $errors["publication_date"] ?></p>

        <input type="submit" value="Save Books">
    </form>
    <a href="viewbook.php"><button type="button">View All Books</button></a>
</body>
</html>