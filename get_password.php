  
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
      // Récupération du nom d'utilisateur
      $username = $_POST['username'];
  
      // Requête SQL pour récupérer le mot de passe de l'utilisateur
      $sql = "SELECT password FROM login WHERE username = '$username'";
  
      // Exécution de la requête
      $result = $conn->query($sql);
  
      // Vérification du résultat
      if ($result->num_rows > 0) {
          // Récupération du mot de passe
          $password = $result->fetch_assoc()['password'];
          echo "<script>document.getElementById('password').innerHTML = 'Mot de passe : " . $password . "'; document.getElementById('password').style.display = 'block';</script>";
      } else {
          echo "<script>document.getElementById('password').innerHTML = 'Erreur : impossible de récupérer le mot de passe'; document.getElementById('password').style.display = 'block';</script>";
      }
  }
  
  // Fermeture de la connexion à la base de données
  $conn->close();
  ?>