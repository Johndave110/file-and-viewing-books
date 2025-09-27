<?php
require_once "../classes/Books.php";

$booksObj = new Books();
$genres = $booksObj->getGenres();

$books = ["title"=>"", "author"=>"", "genre_id"=>"", "publication_date"=>""];
$errors = ["title"=>"", "author"=>"", "genre_id"=>"", "publication_date"=>"" ];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $books["title"] = trim(htmlspecialchars($_POST["title"]));
    if(empty($books["title"])){
        $errors["title"] = "Please put the book title";
    }

    $books["author"] = trim(htmlspecialchars($_POST["author"]));
    if(empty($books["author"])){
        $errors["author"] = "Please put the Author name";
    }

    $books["genre_id"] = trim(htmlspecialchars($_POST["genre_id"]));
    if(empty($books["genre_id"])){
        $errors["genre_id"] = "Please select a Genre";
    }

    $books["publication_date"] = trim(htmlspecialchars($_POST["publication_date"]));
    if(empty($books["publication_date"])){
        $errors["publication_date"] = "Please put a Publication Date";
    }

    if(empty(array_filter($errors))){
        $booksObj->title = $books["title"];
        $booksObj->author = $books["author"];
        $booksObj->genre_name = $books["genre_id"];
        $booksObj->publication_date = $books["publication_date"];

        if($booksObj->addBooks()){
            echo "success";
            $books = ["title"=>"", "author"=>"", "genre_id"=>"", "publication_date"=>""];
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
        p{ color: red; }
        span{ color: red; }
    </style>
</head>
<body>
    <h1>Library Inventory</h1>
    <form action="" method="post">
        <label for="title">Title <span>*</span></label><br>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($books["title"]) ?>"><br>
        <p><?= $errors["title"] ?></p>

        <label for="author">Author <span>*</span></label><br>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($books["author"]) ?>"><br>
        <p><?= $errors["author"] ?></p>

        <label for="genre_id">Genre <span>*</span></label><br>
        <select name="genre_id" id="genre_id">
            <option value="">-- Select Genre --</option>
            <?php foreach($genres as $genre): ?>
                <option value="<?= $genre['genre_id'] ?>"
                    <?= ($books['genre_id'] == $genre['genre_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genre['genre_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p><?= $errors["genre_id"] ?></p>

        <label for="publication_date">Publication date <span>*</span></label><br>
        <input type="date" name="publication_date" value="<?= htmlspecialchars($books["publication_date"])?>">
        <p><?= $errors["publication_date"] ?></p>

        <input type="submit" value="Save Books">
    </form>
    <a href="viewbook.php"><button type="button">Library</button></a>
</body>
</html>