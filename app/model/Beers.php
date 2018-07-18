<?php

class Beers extends Model {

// ******** recupère une liste de 3 bières au hasard  ********

public static function getRandom(){

        $db = Database::getInstance();
        $sql = "SELECT * FROM  beer, categories, style 
                WHERE cat_BEE = id_CAT 
                AND style_BEE = id_STY
                ORDER by RAND() LIMIT 3";

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
}


/* REQUETE FACTORISEE */

// ******** Récupère 1 bière par son id ********

public static function getBeer($id) {

        $db = Database::getInstance();
        $sql = "SELECT * FROM beer 
                WHERE id_BEE = :id";

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
}

// ******** Récupère le style de la bière séléctionnée par son ID ********

public static function getStyle($id) {

        $db = Database::getInstance();
        $sql = "SELECT name_STY FROM style AS S 
                INNER JOIN beer AS B
                ON s.id_STY = b.style_BEE
                AND b.id_BEE = :id
               ";

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
}


// ******** Récupère la nationalité de la bière par son id ********

   public static function getNationalite($id) {

        $db = Database::getInstance();
        $sql = "SELECT name_CAT FROM categories 
                INNER JOIN beer
                ON categories.id_CAT = beer.cat_BEE
                AND beer.id_BEE = :id
               ";

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':id', intval($id), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
}


// ******** recherche par degrés categories styles nom de bière **********

// degBeermin => degrés / degBeerMax => degrés / nom => recherche bière / nationalite => nationalite des bières / styleBeer => style de bière
   
public static function searchBeer($values) {

  /*  $sBeer="%".strip_tags($_POST["nom"])."%";
   $sCat=strip_tags($_POST["nationalite"]);
   $sStyle="%".strip_tags($_POST["styleBeer"])."%";
   $sDegMin=strip_tags($_POST["degBeerMin"]);
   $sDegMax=strip_tags($_POST["degBeerMax"]); */
   
        if(isset($_POST['submitForm'])){
   
        $db = Database::getInstance();
        $sql = "SELECT * FROM beer as b
                inner join categories as c
                inner join style as s
                WHERE 1 = 1";

        if(!empty($values['nationalite'])){
                $sql .= " AND b.cat_BEE =" . $values['nationalite'];
        }

        if(!empty($values['styleBeer'])){
                $sql .= " AND s.name_STY like '%" . $values['styleBeer'] . "%'";
        }

        if(!empty($values['nom'])){
                $sql .= " AND b.name_BEE like '%" . $values['nom']. "%'";
        }

        if(!empty($values['degBeer'])){
                $sql .= " AND b.deg_BEE <=" . $values['degBeer'];

        }

        $sql .= " AND b.cat_BEE = c.id_CAT
                  AND b.style_BEE = s.id_STY";

        $sql .= " ORDER BY RAND()
                 LIMIT 50
                ";

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
  
}
}