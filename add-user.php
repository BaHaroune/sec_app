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

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO utilisateurs (username, password, email) VALUES ('$username', '$password', '$email')";

    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur ajouté avec succès !";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
