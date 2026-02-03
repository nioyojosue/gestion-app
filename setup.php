<?php
try {
    // Connexion à la base de données
    $connexion = new PDO("mysql:host=localhost;dbname=gestion_stock_dclic", "root", "root");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Exécution des scripts SQL...</h2>";
    
    // Lire le fichier SQL
    $sql = file_get_contents('modifications_bdd.sql');
    
    // Exécuter les requêtes SQL
    $queries = explode(';', $sql);
    $count = 0;
    
    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            try {
                $connexion->exec($query);
                echo "✓ Requête exécutée<br>";
                $count++;
            } catch (PDOException $e) {
                echo "✗ Erreur: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<h3 style='color: green;'>Succès! $count requêtes exécutées.</h3>";
    echo "<p><a href='index.php'>Retour à l'accueil</a></p>";
    
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}
?>

