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
  <title>Test Post</title>

</head>

<body>
  <?php include "navbar.php" ?>

  <div class="container ">
    <div class="row m-5">
      <div class="col m-5">

        <form action="articles_post.php" method="post">
          <div class="form-group">
            <input type="hidden" class="form-control" id="blog_id" name="blog_id" value="1">
          </div>
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="title">
          </div>
          <div class="form-group">
            <label for="date_post">
              <!--<?php echo date("d/m/y", time()) ?> -->
            </label>
            <input type="hidden" class="form-control" id="date_post" name="date_post" value="<?= time() ?>">
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="author" name="author" value="1">
          </div>
          <div class="form-group">
            <label for="content">Texte</label>
            <textarea class="form-control" rows="3" id="content" placeholder="Content" name="content"></textarea>
          </div>
          <div class="form-group">
            <div class="input-group mb-3">
              <label class="input-group-text" for="id_tag">Tags</label>
              <select class="custom-select" id="id_tag" name="id_tag">
                <option selected>Choose tags...</option>

                <?php
                $tabTag = $dbh->requeteSelect("tag");
                foreach ($tabTag as $tag) {
                  print_r($tag)
                ?>

                  <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                <?php
                }
                ?>


              </select>

              <div class="mt-2"><button type="submit" class="btn btn-primary">Submit</button></div>

        </form>
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