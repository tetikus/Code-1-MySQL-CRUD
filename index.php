<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD with MySQL</title>
</head>

<body>
    <h2>Book Registration Detail</h2>
    <?php require_once 'process.php'; ?>

    <?php

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>

    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } ?>

    <div class="main-kotak">
        <fieldset>
            <table class="kotak">
                <thead>
                    <tr>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Genre</th>
                    </tr>
                </thead>

                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td class="data-content"> <?php echo $row['author']; ?></td>
                        <td class="data-content"> <?php echo $row['title']; ?></td>
                        <td class="data-content"> <?php echo $row['genre']; ?></td>
                        <td>
                            <a href="process.php?delete= <?php echo $row['id']; ?>" class="butang">Delete</a>
                            <a href="index.php?edit= <?php echo $row['id']; ?>" class="butang">Edit</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </fieldset>
    </div>

    <?php
    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>
    <form action="process.php" method="POST" class="formBody">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="author">Author Name: </label>
        <input type="text" name="author" value="<?php echo $author; ?>" id="author" placeholder="Insert Author Name">
        <label for="title">Title Book: </label>
        <input type="text" name="title" value="<?php echo $title; ?>" id="title" placeholder="Insert Book Title">
        <label for="genre">Book Genre: </label>
        <input type="text" name="genre" value="<?php echo $genre; ?>" id="genre" placeholder="Insert Book Genre">

        <?php
        if ($update == true) :
        ?>
            <button type="submit" name="update" class="hantar">Update</button>
        <?php else : ?>
            <button type="submit" name="submit" class="hantar">Submit</button>
        <?php endif; ?>


    </form>
</body>

</html>