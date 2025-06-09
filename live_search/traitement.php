<?php
header('Content-Type: application/json');
$library = "Margouillat : petit lézard d’Afrique, Iphone : Marque de téléphone de l’entreprise Apple, Algorithme : Ensemble de règles opératoires dont l'application permet de résoudre un problème, Navigateur web : Logiciel permettant d'accéder à des sites internet, Pixel : Le plus petit élément d'une image numérique, RAM : Mémoire vive d'un ordinateur, Virus informatique : Programme malveillant se propageant entre ordinateurs, Lion : Grand félin carnivore vivant en Afrique, souvent appelé le roi de la jungle, Éléphant : Le plus grand mammifère terrestre, connu pour sa trompe et ses défenses, Girafe : Le plus grand mammifère terrestre, réputée pour son très long cou, Zèbre : Équidé africain caractérisé par ses rayures noires et blanches uniques, Tigre : Le plus grand des félins, reconnaissable à son pelage rayé orange et noir, Panda : Ours originaire de Chine, principalement herbivore, se nourrissant de bambou, Kangourou : Marsupial d'Australie connu pour ses grands sauts et sa poche ventrale, Dauphin : Mammifère marin très intelligent, souvent trouvé dans les océans tempérés et tropicaux, Baleine : Grand mammifère marin, le plus grand animal de la planète, Serpent : Reptile sans pattes, se déplaçant par reptation, Araignée : Arthropode à huit pattes, capable de tisser des toiles de soie, Chouette : Oiseau de proie nocturne avec une tête large et des yeux fixés vers l'avant, Aigle : Grand oiseau de proie diurne, aux serres puissantes et à la vue perçante, Gorille : Le plus grand des primates, vivant en Afrique et connu pour sa force, Hippopotame : Grand mammifère semi-aquatique d'Afrique, aux narines et yeux surélevés, Crocodile : Grand reptile aquatique prédateur, aux mâchoires puissantes, Manchot : Oiseau marin incapable de voler, adapté à la vie dans les régions froides, Requin : Grand poisson cartilagineux, prédateur marin, Chauve-souris : Seul mammifère capable de vol soutenu, souvent nocturne, Escargot : Mollusque gastéropode avec une coquille en spirale, se déplaçant lentement, Fourmi : Petit insecte social vivant en grandes colonies organisées, Papillon : Insecte lépidoptère aux ailes colorées, souvent issu d'une chenille.";
$library_lower = strtolower($library);
$definitions = [];
$entries = explode(',', $library_lower);
foreach ($entries as $entry) {
        $entry = trim($entry);
        $parts = explode(':', $entry, 2);
        if (count($parts) === 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                $definitions[$key] = $value;
        }
}
if (isset($_POST['recherche'])) {
        $mot_rechercher = $_POST['recherche'];
        $mot_rechercher_lower = strtolower($mot_rechercher);

        if (isset($definitions[$mot_rechercher_lower])) {
                $message = $definitions[$mot_rechercher_lower];
                echo json_encode(['status' => 'success', 'message' => $message]);
        } else {
                echo json_encode(['status' => 'erreur', 'message' => 'Aucune correspondance pour votre recherche.']);
        }
} else {
        echo json_encode(['status' => 'erreur', 'message' => 'Aucun mot n\'a été entré pour la recherche.']);
}

?>
