<?php

use SYRADEV\Dbg\cnx\cnx as CnxCnx;

include '../../../../../../../../conx/conx.php';
include '/Applications/XAMPP/xamppfiles/htdocs/simplon/php/projet/090/db/connexion.php';


$dbh = new CnxCnx($conf);

$requete = 'SELECT * FROM `user`';



//$res1 = $dbh->requeteSelect($requete, 'fetchAll');
//print_r($res1);


?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Test Post</title>

</head>

<body>
    <?php include "navbar.php" ?>






    <div class="row m-5">
        <div class="col m-5">

            <div class="mt-5">

                <?php $dbh = new CnxCnx($conf);
                $tabArticle = $dbh->requeteSelect("post");

                $tabArticleValues = array_values($tabArticle);

                // afficher les tags du post - les tags du post c'est ceux qui ont id_post



                foreach ($tabArticleValues as $article) {
                    $Comment = $dbh->requeteSelectSpe("comment", 'post_id', $article['id'], 'fetchAll');
                    $nbComment = count($Comment);
                    $tag = $dbh->requeteSelectSpe("post_tag_mm", "id_post", $article['id'], 'fetch');
                    $tagName = $dbh->requeteSelectSpe("tag", 'id', $tag['id_tag'], 'fetch');

                ?>

                    <div class='card mt-5'>
                        <div class='card-body'>
                            <a href='affichage_article.php?id="<?= $article['id'] ?>"'>
                                <h5 class='card-title'> <?= $article['title'] ?> </h5>
                            </a>
                            <p class='card-text'><?= $article['content'] ?></p>
                        </div>
                        <div class='card-footer'>
                            <small class='text-muted'> Commentaire (<?= $nbComment ?>)</small>
                            <!-- <i class="fa fa-trash-o" style="font-size:22px"></i>-->
                            <small class='text-muted'> Tags :
                                <a href='affichage_article.php?id="<?= $article['id'] ?>"'>
                                    (<?= $tagName['name'] ?>)
                                </a>

                            </small>

                        </div>

                    </div>


                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row m-5">
            <div class="card m-5">
                <h5 class="mt-2"> Tags: </h5>
                <?php
                $dbh = new CnxCnx($conf);
                $tagsAff = $dbh->requeteSelect("tag");
                $tagsAffValues = array_values($tagsAff);

                foreach ($tagsAffValues as $tagsElement) {
                ?>
                    <ul class="list-group list-group-flush">
                        <a href='affichage_article.php?id="<?= $article['id'] ?>"'>
                            <li class="list-group-item"><?= $tagsElement['name'] ?></li>
                        </a>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>