COURS SUR LES FICHIERS ET DOSSIERS :
🧭 Plan d’apprentissage : Opérations sur les fichiers en PHP

🧩 Étape 1 : Ouvrir / Créer un fichier =======================================================
✅ Fonction : fopen()

$fichier = fopen("exemple.txt", "w"); // w = write (écriture)
🔸 Modes d’ouverture courants :
Mode	Signification
"r"	Lire uniquement
"w"	Écrire (efface si le fichier existe)
"a"	Ajouter à la fin
"x"	Créer, erreur si déjà existant
"r+"	Lire + écrire
"a+"	Lire + écrire en ajout


🧩 Étape 2 : Écrire dans un fichier
=======================================================
✅ Fonction : fwrite()

$fichier = fopen("exemple.txt", "w");
fwrite($fichier, "Bonjour le monde !");
fclose($fichier); // Toujours fermer après usage
🔒 Important : fclose() libère le fichier. Toujours l’appeler après écriture/lecture.

🧩 Étape 3 : Lire un fichier
=======================================================

✅ Fonction : fread() ou file_get_contents()

$fichier = fopen("exemple.txt", "r");
$contenu = fread($fichier, filesize("exemple.txt"));
fclose($fichier);
echo $contenu;
✅ Alternatif plus simple :

$contenu = file_get_contents("exemple.txt");
echo $contenu;

🧩 Étape 4 : Lire ligne par ligne
=======================================================
$fichier = fopen("exemple.txt", "r");
while (!feof($fichier)) {
    $ligne = fgets($fichier);
    echo $ligne . "<br>";
}
fclose($fichier);

🧩 Étape 5 : Vérifier l'existence d’un fichier
=======================================================
✅ Fonction : file_exists()

if (file_exists("exemple.txt")) {
    echo "Le fichier existe.";
} else {
    echo "Le fichier n'existe pas.";
}

🧩 Étape 6 : Supprimer un fichier
=======================================================
✅ Fonction : unlink()

if (file_exists("exemple.txt")) {
    unlink("exemple.txt");
    echo "Fichier supprimé.";
}

🧩 Étape 7 : Ajouter à la fin d’un fichier
=======================================================
$fichier = fopen("exemple.txt", "a"); // "a" = append
fwrite($fichier, "\nNouvelle ligne");
fclose($fichier);

🧩 Étape 8 : Télécharger un fichier côté client (forcé)
=======================================================
$file = "exemple.txt";
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    readfile($file);
    exit;
}

🧩 Étape 9 : Créer un dossier
=======================================================
mkdir("mon_dossier", 0777, true);

🧩 Étape 10 : Lire tous les fichiers d’un dossier
=======================================================
$files = scandir("mon_dossier");
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo $file . "<br>";
    }
}


🧪 Exercices pratiques proposés :
Créer un fichier et y écrire une phrase.
Lire ce fichier et afficher son contenu.
Ajouter une nouvelle ligne sans effacer l’existant.
Supprimer le fichier via script PHP.
Créer un formulaire HTML pour envoyer un texte → stocker dans un fichier.
Créer un fichier .log et écrire automatiquement l’heure de chaque visite.



Pour déplacer un fichier dans un dossier en PHP, tu peux utiliser la fonction rename(), qui sert à renommer ou déplacer un fichier.
=======================================================
✅ Syntaxe de base

rename("chemin/original/fichier.txt", "nouveau/chemin/fichier.txt");
🧰 Exemple concret : déplacer un fichier

$source = "uploads/fichier.txt";
$destination = "archives/fichier.txt";

if (file_exists($source)) {
    if (rename($source, $destination)) {
        echo "Fichier déplacé avec succès.";
    } else {
        echo "Échec du déplacement.";
    }
} else {
    echo "Le fichier source n'existe pas.";
}



🧠 Qu’est-ce que JSON ?
JSON (JavaScript Object Notation) est un format léger d’échange de données, facile à lire et à écrire pour les humains, facile à parser et générer pour les machines.

C’est l’un des formats les plus utilisés pour transférer des données entre un client (navigateur) et un serveur (ex : PHP).

📦 Structure d’un objet JSON

🔹 Données de type clé-valeur :

{
  "nom": "Alice",
  "age": 25,
  "estAdmin": false
}

🔹 Types de données autorisés : Type JSON	Équivalent

Chaîne	"texte"
Nombre	25, 3.14
Booléen	true, false
Objet	{ "cle": "valeur" }
Tableau	[1, 2, 3]
Null Null

============================= JAVASCRIPT ============================

🛠️ JSON en JavaScript
🔸 Convertir un objet JS → JSON (string)

const user = { nom: "Alice", age: 25 };
const json = JSON.stringify(user);
console.log(json); // '{"nom":"Alice","age":25}'

🔸 Convertir une chaîne JSON → objet JS

const jsonString = '{"nom":"Alice","age":25}';
const user = JSON.parse(jsonString);
console.log(user.nom); // Alice

============================= PHP ============================

JSON en PHP

🔸 Convertir un tableau PHP → JSON
$data = [
  "nom" => "Alice",
  "age" => 25,
  "admin" => false
];
$json = json_encode($data);
echo $json; // {"nom":"Alice","age":25,"admin":false}


🔸 Convertir une chaîne JSON → tableau PHP
$json = '{"nom":"Alice","age":25,"admin":false}';
$data = json_decode($json, true); // true = tableau associatif
echo $data['nom']; // Alice


🔸 Sans true → objet PHP
$data = json_decode($json);
echo $data->nom; // Alice


========================== 🔎 Détails importants =========================

🔐 Encodage UTF-8
JSON est toujours encodé en UTF-8. Attention aux accents et caractères spéciaux si ton fichier PHP n’est pas en UTF-8.

⚠️ Problèmes fréquents avec json_encode()
Il échoue silencieusement si des caractères spéciaux ne sont pas encodables.

Utilise json_last_error() pour vérifier les erreurs.


if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Erreur JSON : " . json_last_error_msg();
}


==================== 📤 JSON dans les API (PHP <-> JS)  ==================


 ============== JS =============
🔸 Exemple d'envoi depuis JS vers PHP via fetch() :

fetch("serveur.php", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({ nom: "Alice", age: 25 })
});

 ============== PHP =============
🔸 Traitement côté PHP :

$donnees = json_decode(file_get_contents("php://input"), true);
echo "Nom : " . $donnees["nom"];