<?php

use SYRADEV\Dbg\cnx\cnx as CnxCnx;

include 'db/connexion.php';

$data = $_POST;

$dbh = new CnxCnx($conf);

$tabTagId = array_slice($data, 5, 1);
unset($data['id_tag']);

$dbh->inserer('post', $data);

$lastId = $dbh->lastID();

unset($data['id_tag']);

$tabTagId ['id_post'] = $lastId;


$dbh->inserer('post_tag_mm', $tabTagId);
header("Location: index.php");
