<?php

namespace SYRADEV\Dbg\cnx;

include '../../../../../../../../conx/conx.php';


use PDO, PDOException;


class cnx
{
    public PDO $dbh;
    public $requete;

    public function __construct($conf)

    {

        
        try {
            $this->dbh = new PDO("mysql:host=" . $conf['db']['host'] . ";dbname=" . $conf['db']['database'], $user = $conf['db']['user'], $pass = $conf['db']['password']);
        } catch (PDOException $e) {
            $message = "Erreur ! " . $e->getMessage() . "<br>";
            die($message);
        }
    }

    public function requeteSelectSpe ($table,$key, $value, $fetchMethod = 'fetch'){

        try {
            $resultat = $this->dbh->query('SELECT * FROM `' . $table . '` WHERE `'. $key  . '` = '. $value  . ' ' , PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch (PDOException $e) {
            $message = "Erreur ! " . $e->getMessage() . "<hr>";
            die($message);
        }
        return $resultat;

    }

    public function requeteSelect($table, $fetchMethod = 'fetchAll')
    {
        try {
            $resultat = $this->dbh->query('SELECT * FROM `' . $table . '`', PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch (PDOException $e) {
            $message = "Erreur ! " . $e->getMessage() . "<hr>";
            die($message);
        }
        return $resultat;
    }

    public function inserer($table, $data)
 
    {
        
        $arrayKeysData = array_keys($data);
        $arrayValuesData = array_values($data);

        $implodeKey = implode(",", $arrayKeysData);
        $tabsValues = [];
            foreach ($data as $elements){
                $tabsValues[] = "?";
            }
        $tabsValues = implode(",", $tabsValues);

        //$requete = 'INSERT INTO '.$table.' ('.$implodeKey.')  VALUES ('. $tabsValues .')';
        $insert = $this->dbh->prepare('INSERT INTO ' . $table . ' (' . $implodeKey . ') VALUES (' . $tabsValues . ')');
        $insert->execute($arrayValuesData);
    }

    public function lastId(){
        return  $this->dbh->lastInsertId();
    }

    public function tagsSelect($tagValue, $fetchMethod = 'fetchAll'){

        try {
            $resultat = $this->dbh->query('SELECT * FROM post_tag_mm JOIN post ON post.id = post_tag_mm.id_post JOIN tag ON tag.id = = post_tag_mm.id_tag WHERE tag.name = '. $tagValue . '', PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch (PDOException $e) {
            $message = "Erreur ! " . $e->getMessage() . "<hr>";
            die($message);
        }
        return $resultat;
    }



}