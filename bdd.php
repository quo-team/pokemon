<?php

function getPDO(){
    $dbName = "pokegame";
    $strConnection = 'mysql:host=127.0.0.1;dbname='.$dbName; //Ligne 1
    $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2
    $pdo =  new PDO($strConnection, "root", "root", $arrExtraParam);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

}


function getDresseur($mail,$mdp){
    $pdo = getPDO();
    $query ="SELECT * FROM dresseur WHERE mail=:mail AND mdp=:mdp";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $prep->execute();
    $res = $prep->fetch();

    return $res;
}

function getPokemonsDresseur($id_dresseur){
    $pdo = getPDO();
    $query = "SELECT * FROM pokemon WHERE id_dresseur=:id_dresseur";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id_dresseur', $id_dresseur, PDO::PARAM_INT);
    $prep->execute();
    $res = $prep->fetchAll();

    return $res;
}

function getStarter(){
    $pdo = getPDO();
    $query ="SELECT * FROM ref_pokemon WHERE starter=1";
    $res = $pdo->query($query)->fetchAll();
    $list_pokemon = array();
    foreach ($res as $pokemon) {
      $new_pokemon = getEspecePokemonById($pokemon['id']);
      array_push($list_pokemon,$new_pokemon);
    }
    return $list_pokemon;
}

function inscription($nom,$mail,$mdp,$starter,$nom_pokemon,$sexe){
    //création du dresseur
    $pdo = getPDO();
    //vérification que le mail n'est pas déja enregistrer
    $query =  $query ="SELECT * FROM dresseur WHERE mail=:mail";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->execute();
    $res = $prep->fetchAll();

    if(!empty($res)){
        return false;
    }

    //insertion dresseur 
    $query = "INSERT INTO dresseur(nom,mail,mdp) VALUES(:nom,:mail,:mdp)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $prep->execute();

    $query = "SELECT MAX(id) as id_max FROM dresseur";
    $prep = $pdo->prepare($query);
    $prep->execute();
    $res = $prep->fetch();
    $max_id_dresseur = $res['id_max'];
    //insertion du pokemon
  $pokemon = getEspecePokemonById($starter);
  $query = "INSERT INTO pokemon(id_dresseur,nom,sexe,espece) VALUES(:id_dresseur,:nom,:sexe,:espece)";
  $prep = $pdo->prepare($query);
  $prep->bindValue(':id_dresseur', $max_id_dresseur, PDO::PARAM_STR);
  $prep->bindValue(':nom', $nom_pokemon, PDO::PARAM_STR);
  $prep->bindValue(':sexe', $sexe, PDO::PARAM_STR);
  $prep->bindValue(':espece', $pokemon -> getId(), PDO::PARAM_STR);
  $prep->execute();

    return true;
}

function getPokemonByid($id){
    $pdo = getPDO();
    $query = "SELECT * FROM pokemon WHERE id=:id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_STR);
    $prep->execute();
    $res = $prep->fetch();

    return $res;

}



function getEspecePokemonById($id){
    $pdo = getPDO();
    //Select de tous les types du pokemon
    $query = 'SELECT p.id as pokeId, p.nom, p.evolution, p.type_1, p.type_2  FROM ref_pokemon p WHERE p.id = :id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->execute();
    $res = $prep->fetchAll();

    //init var
    $types = [];
    $id = null;
    $nom = null;
    $evo = null;
    $type1 = null;
    $type2 = null;
    foreach($res as $row){
        if(!isset($poke)){
            $id =$row['pokeId'];
            $nom =$row['nom'];
            $type1 =$row['type_1'];
            $type2 =$row['type_2'];
            $evo =$row['evolution'];
        }


    }
    return new EspecePokemon($id,$nom,$type1,$type2,$evo);

}


