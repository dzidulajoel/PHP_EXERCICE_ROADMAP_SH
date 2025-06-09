<?php
include('__insert.php');
include('__get.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JobZoo</title>
        <link rel="stylesheet" href="style.css">

</head>

<body>
        <div class="header">
                <h1>JobZoo</h1>
        </div>
        <section>
                <h2>Découvrez les Compétences Tech de l’Afrique Francophone 💼</h2>
                <div class="display_items">
                        <?php foreach ($resultats as $resultat): ?>
                                <?php

                                        $lettre_nom = strtoupper(substr($resultat['nom'], 0, 1));
                                        $lettre_prenom = strtoupper(substr($resultat['prenom'], 0, 1));
                                        $initiales = $lettre_nom .$lettre_prenom;

                                        $hash = md5($initiales); 
                                        $color = '#' . substr($hash, 0, 6); 
                                ?>
                                <div class="profil">
                                        <div class="nom">
                                                <div class="ident"  style="background-color: <?= $color ?>;">
                                                        <?php echo strtoupper($initiales); ?>
                                                </div>
                                                <span><?php echo $resultat['nom'] . " " . $resultat['prenom']; ?></span>
                                        </div>
                                        <ul>
                                                <li> <strong>email</strong> :<?php echo $resultat['email']; ?></li>
                                                <li> <strong>categories</strong> :<?php echo $resultat['categories']; ?></li>
                                                <li> <strong>pays</strong> : <?php echo $resultat['pays']; ?></li>
                                                <?php if ($resultat['statut_professionnel'] === "actif"): ?>
                                                        <li class="actif"><strong>statut</strong> :
                                                                <?php echo $resultat['statut_professionnel']; ?></li>
                                                <?php elseif ($resultat['statut_professionnel'] === "chomage"): ?>
                                                        <li class="chomage"><strong>statut</strong> :
                                                                <?php echo $resultat['statut_professionnel']; ?></li>
                                                <?php else: ?>
                                                        <li class="retraite"><strong>statut</strong> :
                                                                <?php echo $resultat['statut_professionnel']; ?></li>
                                                <?php endif; ?>
                                        </ul>
                                        <a href="profil.php?id=<?php echo $resultat['token'] ?>" class="lien_profil">Voir le profil</a>
                                </div>
                        <?php endforeach; ?>
                </div>
        </section>
</body>

</html>