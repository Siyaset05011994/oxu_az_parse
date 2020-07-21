<?php

include('Connection.php');

$database=new Connection();
$db=$database->openConnection();

$news=$db->query('SELECT * FROM news INNER JOIN categories ON news.category_id=categories.id ORDER BY view_count DESC ');
$news=$news->fetchAll();

$database->closeConnection();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <h1>Common Count <?php echo count($news)?> </h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Likes</th>
            <th>Dislikes</th>
            <th>View Count</th>
            <th>Content</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($news as $n) { ?>
            <tr>
                <td><?php echo $n['news_id'] ?></td>
                <td><?php echo $n['name'] ?></td>
                <td><?php echo $n['title'] ?></td>
                <td><?php echo $n['likes'] ?></td>
                <td><?php echo $n['dislikes'] ?></td>
                <td><?php echo $n['view_count'] ?></td>
                <td><?php echo mb_substr($n['content'],0,100) ?>...</td>
                <td><?php echo $n['date'] ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

