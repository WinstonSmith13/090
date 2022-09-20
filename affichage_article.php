<?php

use SYRADEV\Dbg\cnx\cnx as CnxCnx;

include '../../../../../../../../conx/conx.php';
include '/Applications/XAMPP/xamppfiles/htdocs/simplon/php/projet/090/db/connexion.php';


$dbh = new CnxCnx($conf);


$key = array_keys($_GET);
$value = array_values($_GET);



$articles = $dbh->requeteSelectSpe("post", $key[0], $value[0]);



?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_comment.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>
        <?php
        echo $articles['title']
        ?>
    </title>
</head>

<body>
    <?php include "navbar.php" ?>

    <div class='card-group m-5'>
        <div class='card mt-5'>
            <div class='card-body'>
                <h5 class='card-title'><?= $articles['title']  ?></h5>
                <p class='card-text'><?= $articles['content']  ?></p>
            </div>
        </div>
    </div>

    <div class="m-5">
        <form class="form-block" action='comment_post.php?id="<?= $articles['id'] ?>"' method='post'>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group fl_icon">
                        <div class="icon d-flex align-items-center justify-content-center"><i class="fa fa-user d-flex align-items-center"></i></div>
                        <input class="form-input" type="text" placeholder="Votre nom" id='author' name='author'>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 fl_icon">
                    <div class="form-group fl_icon">
                        <div class="icon d-flex align-items-center justify-content-center"><i class="fa fa-envelope-o "></i></div>
                        <input class="form-input" type="text" id='email' name='email' placeholder="Votre email">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <textarea class="form-input" required="" id='content' name='content' placeholder="Ton commentaire ..."></textarea>
                        <input type='hidden' class='form-control' id='post_id' name='post_id' value='<?= $articles['id'] ?>'>
                        <input type='hidden' class='form-control' id='date_comment' name='date_comment' value="<?= date("Y-m-d H:i:s") ?>">
                    </div>
                </div>
                <div>
                    <button type='submit' class='btn btn-dark'>Submit</button>
                </div>

            </div>
        </form>
    </div>

    </div>









    <?php
    $dbh = new CnxCnx($conf);


    $tabComment = $dbh->requeteSelectSpe("comment", 'post_id', $articles['id'], 'fetchAll');

    $tabCommentValues = array_values($tabComment);
    foreach ($tabCommentValues as $comment) {
    ?>

        
               <Div class="container">
                    <div class="be-comment-content">

                        <span class="be-comment-name">
                            <a href="blog-detail-2.html"><?= $comment['author'] ?></a>
                        </span>
                        <span class="be-comment-time">
                            <i class="fa fa-clock-o"></i>
                            <?= $comment['date_comment'] ?>
                        </span>

                        <p class="be-comment-text">
                        <?= nl2br($comment['content']); ?>
                        </p>
                    </div>
                
                    </Div>
            <?php
        }
            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>