<form action="index.php?action=connexion" method="post">
    <label for="mail_compte" >Mail : </label>
<input type="mail" id="mail_compte" name="mail_compte" required>
<label for="mdp_compte">Mot de passe: </label>
<input type="password" name="mdp_compte" id="mdp_compte" required>
<input type="submit" name="bt_connexion" value="se connecter">

</form>

<?php
if(isset($incorrect)){
    echo "Mail ou mdp incorrect";
}
?>