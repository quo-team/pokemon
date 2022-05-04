<div class="card" style="width: 80%;margin: auto">
    <div class="card-body">
       
     <?php

     if(!isset($_SESSION['connexion'])){
         echo "<a href='index.php?action=inscription'>S'inscrire</a><br>";
         
         echo "<a href='index.php?action=connexion'>Se connecter</a>";
     }else{
         
        echo "<a href='index.php?action=deconnexion'>Se déconnecter</a><br>";
        echo "nombre de pièces : ".$_SESSION['connexion']['pieces'];
        
        include $page_home.".php";
     }?>

   
    </div>
</div>

