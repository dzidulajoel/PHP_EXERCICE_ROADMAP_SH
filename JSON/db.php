<?php
$host = 'localhost';
$dbname = 'ajax';
$user = 'root';
$pass = '';
try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
        echo "❌ Erreur de connexion : " . $e->getMessage();
        exit;
}

