<style>
    .container {
      width: 300px;
      margin: 40px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  
    label {
      display: block;
      margin-bottom: 10px;
    }
  
    input[type="text"] {
      width: 100%;
      height: 40px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  
    button {
      width: 100%;
      height: 40px;
      background-color: #4CAF50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  
    button:hover {
      background-color: #3e8e41;
    }
  
    #password {
      display: none;
    }
  </style>
  
  <div class="container">
    <h2>Afficher le mot de passe de l'utilisateur</h2>
    <form action="get_password.php" method="post">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username"><br><br>
      <button type="submit">Afficher le mot de passe</button>
      <p id="password"></p>
    </form>
  </div>
  
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