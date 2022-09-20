<?php

use SYRADEV\Dbg\cnx\cnx as CnxCnx;

include 'db/connexion.php';

$data = $_POST;
$postId = $_GET;
$postIdValue = array_values($postId);

print_r($postIdValue);


$dbh = new CnxCnx($conf);

$dbh->inserer('comment', $data);

//header("Location: index.php");

header("Location: affichage_article.php?id=$postIdValue[0]");