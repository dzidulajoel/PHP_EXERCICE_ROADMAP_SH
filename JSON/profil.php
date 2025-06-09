<?php
require_once('db.php');
include('__get.php');

$token = $_GET['id'] ?? '';

$sql = "SELECT * FROM emploi WHERE token = :token";
$req = $pdo->prepare($sql);
$req->execute([':token' => $token]);
$data = $req->fetch(PDO::FETCH_ASSOC);

$progr = json_decode($data['langages_programmation']);

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
                <div class="display_profil">
                        <div class="profil_1">
                                <?php

                                $lettre_nom = strtoupper(substr($data['nom'], 0, 1));
                                $lettre_prenom = strtoupper(substr($data['prenom'], 0, 1));
                                $initiales = $lettre_nom . $lettre_prenom;

                                $hash = md5($initiales);
                                $color = '#' . substr($hash, 0, 6);
                                ?>
                                <div class="icons_name" style="background-color: <?= $color ?>;">
                                        <?php echo strtoupper($initiales); ?>
                                </div>
                                <h3><?php echo htmlspecialchars($data['nom'] . " " . $data['prenom']); ?></h3>
                                <h4>Informations professionnelles</h4>
                                <ul class="personnel">
                                        <li><strong class="str">Statut</strong>
                                                :<?php echo htmlspecialchars($data['statut_professionnel']); ?></li>
                                        <li><strong class="str">Categorie</strong> :
                                                <?php echo htmlspecialchars($data['categories']); ?></li>
                                        <li><strong class="str">Niveau d'etude</strong> :
                                                <?php echo htmlspecialchars($data['niveau_etude']); ?></li>
                                        <li><strong class="str">Languages de programmation</strong> :
                                                <ul>
                                                        <?php foreach ($progr as $pro): ?>
                                                                <li> ♦ <?php echo $pro; ?></li>
                                                        <?php endforeach ?>
                                                </ul>
                                        </li>
                                        <li><strong class="str">Email</strong> :
                                                <?php echo htmlspecialchars($data['email']); ?></li>
                                        <li><strong class="str">Tel</strong> :
                                                <?php echo htmlspecialchars($data['telephone_id']); ?></li>
                                        <li><strong class="str">Prix de service</strong> :
                                                <?php echo htmlspecialchars(number_format($data['service_prix_cfa'], 0, '', ' ')); ?>
                                                FCFA</li>
                                        <li><strong class="str">Portfolio</strong> :<a
                                                        href="<?php echo $data['portfolio'] ?>"><?php echo $data['portfolio'] ?></a>
                                        </li>
                                </ul>
                        </div>
                        <div class="profil_2">
                                <h4>Informations personnelle</h4>
                                <ul class="personnel">
                                        <li><strong class="str">Pays</strong>
                                                :<?php echo htmlspecialchars($data['pays']); ?></li>
                                        <li><strong class="str">Ville</strong> :
                                                <?php echo htmlspecialchars($data['ville']); ?></li>
                                        <li><strong class="str">Age</strong> :
                                                <?php echo htmlspecialchars($data['age']); ?> ans</li>
                                        <li><strong class="str">Biographie</strong> : <p>
                                                        <?php echo htmlspecialchars($data['profil']); ?></p>
                                        </li>
                                </ul>
                                <div class="actions">
                                        <button type="button">Collaborer</button>
                                        <button type="button">Partager</button>
                                        <button type="button">Telecharger le CV</button>
                                </div>
                        </div>
                </div>
        </section>
</body>

</html>