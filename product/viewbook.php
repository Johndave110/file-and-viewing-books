<?php
    require_once "../classes/Books.php";
    $bookObj = new Books();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Book List</h1>
    <a href="../product/addbook.php" class="viewbook">Add Books</a>
    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Publication Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($bookObj->viewBook() as $books){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $books["title"] ?></td>
                <td><?= $books["author"] ?></td>
                <td><?= $books["genre_name"] ?></td>
                <td><?= $books["publication_date"] ?></td>  
                <td>
                    <a href="editbook.php?id=<?= $books["book_id"] ?>">Edit</a>
                    <a href="delete.php?id=<?= $books["book_id"] ?>" onclick="return">Delete</a>
                </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>