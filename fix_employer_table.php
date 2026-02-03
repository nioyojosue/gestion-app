<?php
try {
    // Connexion à la base de données
    $connexion = new PDO("mysql:host=localhost;dbname=gestion_stock_dclic", "root", "root");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Vérification de la structure de la table employer...</h2>";
    
    // Vérifier les colonnes de la table employer
    $sql = "DESCRIBE employer";
    $req = $connexion->query($sql);
    $columns = $req->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($columns)) {
        echo "<h3>Colonnes actuelles:</h3>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Colonne</th><th>Type</th><th>Null</th><th>Clé</th></tr>";
        foreach ($columns as $col) {
            echo "<tr><td>" . $col['Field'] . "</td><td>" . $col['Type'] . "</td><td>" . $col['Null'] . "</td><td>" . $col['Key'] . "</td></tr>";
        }
        echo "</table>";
    }
    
    // Vérifier si les colonnes nom et prenom existent
    $hasNom = false;
    $hasPrenom = false;
    $hasTelephone = false;
    $hasAdresse = false;
    
    foreach ($columns as $col) {
        if ($col['Field'] === 'nom') $hasNom = true;
        if ($col['Field'] === 'prenom') $hasPrenom = true;
        if ($col['Field'] === 'telephone') $hasTelephone = true;
        if ($col['Field'] === 'adresse') $hasAdresse = true;
    }
    
    echo "<h3>Résultat:</h3>";
    
    if (!$hasNom) {
        echo "<p style='color: red;'>✗ Colonne 'nom' manquante. Ajout en cours...</p>";
        $connexion->exec("ALTER TABLE employer ADD COLUMN nom VARCHAR(50) NOT NULL AFTER id");
        echo "<p style='color: green;'>✓ Colonne 'nom' ajoutée</p>";
    } else {
        echo "<p style='color: green;'>✓ Colonne 'nom' présente</p>";
    }
    
    if (!$hasPrenom) {
        echo "<p style='color: red;'>✗ Colonne 'prenom' manquante. Ajout en cours...</p>";
        $connexion->exec("ALTER TABLE employer ADD COLUMN prenom VARCHAR(50) NOT NULL AFTER nom");
        echo "<p style='color: green;'>✓ Colonne 'prenom' ajoutée</p>";
    } else {
        echo "<p style='color: green;'>✓ Colonne 'prenom' présente</p>";
    }
    
    if (!$hasTelephone) {
        echo "<p style='color: red;'>✗ Colonne 'telephone' manquante. Ajout en cours...</p>";
        $connexion->exec("ALTER TABLE employer ADD COLUMN telephone VARCHAR(20)");
        echo "<p style='color: green;'>✓ Colonne 'telephone' ajoutée</p>";
    } else {
        echo "<p style='color: green;'>✓ Colonne 'telephone' présente</p>";
    }
    
    if (!$hasAdresse) {
        echo "<p style='color: red;'>✗ Colonne 'adresse' manquante. Ajout en cours...</p>";
        $connexion->exec("ALTER TABLE employer ADD COLUMN adresse VARCHAR(255)");
        echo "<p style='color: green;'>✓ Colonne 'adresse' ajoutée</p>";
    } else {
        echo "<p style='color: green;'>✓ Colonne 'adresse' présente</p>";
    }
    
    echo "<h3>Structure finale:</h3>";
    $sql = "DESCRIBE employer";
    $req = $connexion->query($sql);
    $columns = $req->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Colonne</th><th>Type</th><th>Null</th><th>Clé</th></tr>";
    foreach ($columns as $col) {
        echo "<tr><td>" . $col['Field'] . "</td><td>" . $col['Type'] . "</td><td>" . $col['Null'] . "</td><td>" . $col['Key'] . "</td></tr>";
    }
    echo "</table>";
    
    echo "<h3 style='color: green;'>Table employer correctement structurée!</h3>";
    echo "<p><a href='vue/employer.php'>Retour à la gestion des employés</a></p>";
    
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
