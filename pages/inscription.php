<form name="formulaire_inscription" action="index.php?action=inscription" method="post" >
<label for="nom_compte_inscription">Nom : </label>
<input type="text" name="nom_compte_inscription" id="nom_compte_inscription" required>
    <label for="mail_compte_inscription">mail : </label>
    <input type="mail" name="mail_compte_inscription" id="mail_compte_inscription" required>
    <label for="mdp_compte_inscription">mot de passe : </label>
    <input type="password" name="mdp_compte_inscription" id="mdp_compte_inscription" required>
    <label for="select_starter_inscription">starter : </label>
    <select name="select_starter_inscription" id="select_starter_inscription">
    <?php foreach ($starters as $pokemon) {
    echo " <option value=".$pokemon->getId().">".$pokemon->getNom()."</option>";
}
?>
    </select>
    <label for="nom_starter_inscription">Nom du pokemon : </label>
    <input type="text" name="nom_starter_inscription" id="nom_starter_inscription" required>
    <label for="sexe_starters">sexe starter : </label>
    <select name="sexe_starters" id="sexe_starters">
        <option value="mâle">mâle</option>
        <option  value="femelle">femelle</option>
    </select>
    <input type="submit" name="bt_inscription" value="inscription">
  
</form>

<?php if(isset($mail_existant)){
    echo "Le mail saisi existe déjà !";
} ?>