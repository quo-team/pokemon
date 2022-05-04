<h3>Liste des pokémons possédés</h3>

<?php 

$les_pokemons  = getPokemonsDresseur($_SESSION['connexion']['id']);

?>

<table border="1">
<tr >
    <th>nom </th>

</tr>

<?php
foreach($les_pokemons as $poke){

echo "<tr> 
<td> <a href='index.php?action=detail_pokemon&id_pokemon=$poke[id]' >$poke[nom]</a></td>
</tr>";


}
?>


</table>