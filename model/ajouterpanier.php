<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Connexion à la BD
$pdo = new PDO('mysql:host=localhost;dbname=gestion_stock_dclic', 'root', 'root');

// Ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $article = $_POST['article'];
    $quantite = $_POST['quantite'];
    $_SESSION['panier'][$article] = $quantite;
}

// Enregistrement de la commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
    $client = $_POST['client'];
    $restaurant = $_POST['restaurant'];
    
    $stmt = $pdo->prepare("INSERT INTO Commande (date, client_numero, restaurant_code) VALUES (NOW(), ?, ?)");
    $stmt->execute([$client, $restaurant]);
    $commande_id = $pdo->lastInsertId();
    
    foreach ($_SESSION['panier'] as $article => $quantite) {
        $stmt = $pdo->prepare("INSERT INTO LigneCommande VALUES (?, ?, ?)");
        $stmt->execute([$commande_id, $article, $quantite]);
    }
    
    unset($_SESSION['panier']);
    echo "Commande enregistrée !";
}
?>

<form method="post">
    <select name="client">
        <?php foreach ($pdo->query("SELECT * FROM Client") as $c) : ?>
            <option value="<?= $c['numero'] ?>"><?= $c['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <select name="restaurant">
        <?php foreach ($pdo->query("SELECT * FROM Restaurant") as $r) : ?>
            <option value="<?= $r['code'] ?>"><?= $r['adresse'] ?></option>
        <?php endforeach; ?>
    </select>
    <select name="article">
        <?php foreach ($pdo->query("SELECT * FROM Article") as $a) : ?>
            <option value="<?= $a['code'] ?>"><?= $a['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="number" name="quantite" min="1" value="1">
    <button type="submit" name="ajouter">Ajouter au panier</button>
    <button type="submit" name="valider">Valider la commande</button>
</form>

<!-- Affichage du panier -->
<h3>Panier</h3>
<ul>
    <?php foreach ($_SESSION['panier'] as $article => $quantite) : ?>
        <li><?= $article ?> : <?= $quantite ?></li>
    <?php endforeach; ?>
</ul>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=chaine_restaurants', 'root', 'root');
$client_id = $_GET['client'];

// Récupérer les commandes du client
$stmt = $pdo->prepare("
    SELECT c.numero, c.date, r.adresse, SUM(l.quantite * p.prix) AS total
    FROM Commande c
    JOIN Restaurant r ON c.restaurant_code = r.code
    JOIN LigneCommande l ON c.numero = l.commande_numero
    JOIN Proposer p ON l.article_code = p.article_code AND c.restaurant_code = p.restaurant_code
    WHERE c.client_numero = ?
    GROUP BY c.numero
");
$stmt->execute([$client_id]);
$commandes = $stmt->fetchAll();

// Afficher la facture
foreach ($commandes as $cmd) {
    echo "<h2>Commande #{$cmd['numero']} - {$cmd['date']}</h2>";
    echo "<p>Restaurant : {$cmd['adresse']}</p>";
    echo "<p>Total : {$cmd['total']} FCFA</p>";
}
?>