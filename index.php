<?php
//ini_set('error_reporting', E_ALL);

require_once "espece_pokemon.php";
require_once "bdd.php";

session_start();


function getFieldFromForm($name){
    return isset($_POST[$name])?$_POST[$name]:(isset($_GET[$name])?$_GET[$name]:null);
}

function getArrayFieldFromForm($name){
    return isset($_POST[$name])?$_POST[$name]:(isset($_GET[$name."[]"])?$_GET[$name."[]"]:null);
}

//Recuperer les parametres
$page = getFieldFromForm("page");
if(!isset($page)){
    $page="home";
    $dresseur  = isset($_SESSION['connexion']) ? $_SESSION['connexion'] : false;
    if($dresseur != false){
        $page_home="pokemon";
    }
}

//Gestion des actions
$action = getFieldFromForm("action");
switch ($action){
        case "connexion":

            if(!isset($_POST['bt_connexion'])){
                $page="login";
            }else{
                $mail = $_POST['mail_compte'];
                $mdp = $_POST['mdp_compte'];
                $getDresseur = getDresseur($mail,$mdp);
                 if(!empty($getDresseur)){
                        $_SESSION['connexion'] = $getDresseur;
                        $page_home="pokemon";
                    }else{
                        $incorrect = true;
                        $page = "login";
                    }
            }
        break;

        case "inscription" :
            if(!isset($_POST['bt_inscription'])){
                $page="inscription";
                $starters = getStarter();
            }else{
                $nom = $_POST['nom_compte_inscription'];
                $mail = $_POST['mail_compte_inscription'];
                $mdp = $_POST['mdp_compte_inscription'];
                $starter = $_POST['select_starter_inscription'];
                $nom_pokemon =  $_POST['nom_starter_inscription'];
                $sexe=$_POST['sexe_starters'];;
               if(!inscription($nom,$mail,$mdp,$starter,$nom_pokemon,$sexe)){
                   $mail_existant = true;
                   $page = "inscription";
               }
            }
        
            break;

        case "detail_pokemon":
            $page_home="detail";
            $id_pokemon = getFieldFromForm("id_pokemon");
            $le_pokemon = getPokemonByid($id_pokemon);
            $espece_pokemon= getEspecePokemonById($le_pokemon['espece']);    
            break;

            case "deconnexion":
                session_destroy();
           $page="home";
                break;


        
}




include "header.php";
include "menu.php";
include "pages/$page.php";
include "footer.php";