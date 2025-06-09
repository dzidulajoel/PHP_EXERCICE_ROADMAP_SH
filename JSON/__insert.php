<?php
require_once('db.php');

try {
        // Charger et décoder le fichier JSON
        $json = file_get_contents('employes_afrique_ouest_v2.json');
        $employes = json_decode($json, true);

        // Démarrer la transaction
        $pdo->beginTransaction();
        // Préparer la requête SQL une seule fois
        $sql = "INSERT INTO emploi 
        (nom, prenom, email, telephone_id, age, statut_professionnel, niveau_etude, profil, pays, ville, domaine, categories, langages_programmation, portfolio, service_prix_cfa, token) 
        VALUES 
        (:nom, :prenom, :email, :telephone_id, :age, :statut_professionnel, :niveau_etude, :profil, :pays, :ville, :domaine, :categories, :langages_programmation, :portfolio, :service_prix_cfa, :token)";

        $req = $pdo->prepare($sql);

        foreach ($employes as $employe) {
                $token = bin2hex(random_bytes(8));
                $req->execute([
                        ":nom" => $employe['nom'],
                        ":prenom" => $employe['prenom'],
                        ":email" => $employe['email'],
                        ":telephone_id" => $employe['telephone_id'],
                        ":age" => $employe['age'],
                        ":statut_professionnel" => $employe['statut_professionnel'],
                        ":niveau_etude" => $employe['niveau_etude'],
                        ":profil" => $employe['profil'],
                        ":pays" => $employe['pays'],
                        ":ville" => $employe['ville'],
                        ":domaine" => $employe['domaine'],
                        ":categories" => $employe['categories'],
                        ":langages_programmation" => json_encode($employe['langages_programmation']),
                        ":portfolio" => $employe['portfolio'],
                        ":service_prix_cfa" => $employe['service_prix_cfa'],
                        ":token" =>$token
                ]);
        }

        $pdo->commit();

} catch (PDOException $e) {
        $pdo->rollBack();
}