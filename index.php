<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'hr';
$user = 'root';
$pass = '';

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des informations du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Requête SQL pour vérifier les informations
$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";

// Exécution de la requête
$result = $conn->query($sql);

// Vérification du résultat
if ($result->num_rows > 0) {
    // Si les informations sont correctes, on peut afficher un message de bienvenue
    echo "Bienvenue, $username !";
} else {
    // Si les informations sont incorrectes, on peut afficher un message d'erreur
    echo "Erreur de connexion : les informations sont incorrectes.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
