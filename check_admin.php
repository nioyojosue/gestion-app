<?php
try {
    // Connexion à la base de données
    $connexion = new PDO("mysql:host=localhost;dbname=gestion_stock_dclic", "root", "root");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Vérification de l'admin...</h2>";
    
    // Vérifier si l'admin existe
    $sql = "SELECT * FROM admin WHERE email = 'admin@admin.com'";
    $req = $connexion->query($sql);
    $admin = $req->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "<p style='color: green;'>✓ Admin trouvé dans la base de données!</p>";
        echo "<p>Email: " . $admin['email'] . "</p>";
        echo "<p>Mot de passe: " . $admin['password'] . "</p>";
    } else {
        echo "<p style='color: red;'>✗ Admin introuvable. Insertion en cours...</p>";
        
        // Insérer l'admin
        $sql = "INSERT INTO admin (nom, prenom, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(array('Admin', 'Admin', 'admin@admin.com', 'admin123'));
        
        echo "<p style='color: green;'>✓ Admin inséré avec succès!</p>";
        echo "<p>Email: admin@admin.com</p>";
        echo "<p>Mot de passe: admin123</p>";
    }
    
    echo "<h3>Liste de tous les admins:</h3>";
    $sql = "SELECT id, nom, prenom, email FROM admin";
    $req = $connexion->query($sql);
    $admins = $req->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($admins)) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th></tr>";
        foreach ($admins as $a) {
            echo "<tr><td>" . $a['id'] . "</td><td>" . $a['nom'] . "</td><td>" . $a['prenom'] . "</td><td>" . $a['email'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun admin trouvé</p>";
    }
    
    echo "<h3>Liste de tous les employers:</h3>";
    $sql = "SELECT id, nom, prenom, email FROM employer";
    $req = $connexion->query($sql);
    $employers = $req->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($employers)) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th></tr>";
        foreach ($employers as $e) {
            echo "<tr><td>" . $e['id'] . "</td><td>" . $e['nom'] . "</td><td>" . $e['prenom'] . "</td><td>" . $e['email'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun employer trouvé</p>";
    }
    
    echo "<h3>Test de connexion</h3>";
    echo "<p><a href='../index.php'>Retour à l'accueil</a></p>";
    
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
