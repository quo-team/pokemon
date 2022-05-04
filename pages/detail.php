<H3>Détails pokémon</H3>

<table border="1">
    <thead>
    <tr>
        <th>nom</th>
        <th>xp</th>
        <th>niveau</th>
        <th>sexe</th>
        <th>espece</th>
        <th>type1</th>
        <th>type2</th>
        <th>évolution</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $le_pokemon['nom'];?></td>
        <td><?php echo $le_pokemon['xp']; ?></td>
        <td><?php echo $le_pokemon['niveau']; ?></td>
        <td><?php echo $le_pokemon['sexe']; ?></td>
        <td><?php echo $espece_pokemon->getNom(); ?></td>
        <td><?php echo $espece_pokemon->getType1(); ?></td>
        <td><?php echo $espece_pokemon->getType2(); ?></td>
        <td><?php echo $espece_pokemon->isEvolution(); ?></td>
    </tr>

    </tbody>
    
</table>