<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hr";

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des informations du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Solution: preparer la requete en separant les donnees des instructions
$stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

// Exécution de la requête
$stmt->execute();
$result = $stmt->get_result();

// Vérification du résultat
if ($result->num_rows > 0) {
    // Si les informations sont correctes, on peut afficher un message de bienvenue
    header("Location: succes.php");
} else {
    // Si les informations sont incorrectes, on peut afficher un message d'erreur
    echo "Erreur de connexion : les informations sont incorrectes.";
}

// Fermeture de la connexion à la base de données
$stmt->close();
$conn->close();
 ?>