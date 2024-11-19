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

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO login VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Utilisateur ajouté avec succès !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
