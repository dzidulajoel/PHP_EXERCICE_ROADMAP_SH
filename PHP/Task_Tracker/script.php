<?php
        $json = file_get_contents('db.json');
        $datas = json_decode($json, true);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? '';

        if (empty($description) || empty($status)) {
                echo json_encode([
                        'success' => false,
                        'message' => 'Champs requis manquants.'
                ]);
                exit;
        }




        $nouvelleTache = [
                'id' => uniqid(),
                'description' => $description,
                'status' => $status,
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
        ];

        $datas[] = $nouvelleTache;

        file_put_contents($fichier, json_encode($datas, JSON_PRETTY_PRINT));
}
