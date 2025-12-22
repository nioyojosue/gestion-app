<?php
include 'entete.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$scope = isset($_GET['scope']) ? $_GET['scope'] : 'all';

$results = [];

if (!empty($q)) {
    if ($scope == 'client' || $scope == 'all') {
        $clients = searchClientByName($q);
        if (!empty($clients)) $results['clients'] = $clients;
    }
    if ($scope == 'fournisseur' || $scope == 'all') {
        $fournisseurs = searchFournisseurByName($q);
        if (!empty($fournisseurs)) $results['fournisseurs'] = $fournisseurs;
    }
    if ($scope == 'article' || $scope == 'all') {
        $articles = searchArticleByName($q);
        if (!empty($articles)) $results['articles'] = $articles;
    }
    if ($scope == 'vente' || $scope == 'all') {
        $ventes = searchVenteByKeyword($q);
        if (!empty($ventes)) $results['ventes'] = $ventes;
    }
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <h2>Résultats de recherche pour: "<?= htmlentities($q) ?>" (scope: <?= htmlentities($scope) ?>)</h2>

            <?php if (empty($q)) { ?>
                <p>Veuillez saisir un mot-clé pour lancer la recherche.</p>
            <?php } else { ?>

                <?php if (empty($results)) { ?>
                    <p>Aucun résultat trouvé.</p>
                <?php } else { ?>

                    <?php if (!empty($results['clients'])) { ?>
                        <h3>Clients</h3>
                        <table class="mtable">
                            <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Adresse</th></tr>
                            <?php foreach ($results['clients'] as $c) { ?>
                                <tr>
                                    <td><?= htmlentities($c['nom']) ?></td>
                                    <td><?= htmlentities($c['prenom']) ?></td>
                                    <td><?= htmlentities($c['telephone']) ?></td>
                                    <td><?= htmlentities($c['adresse']) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>

                    <?php if (!empty($results['fournisseurs'])) { ?>
                        <h3>Fournisseurs</h3>
                        <table class="mtable">
                            <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Adresse</th></tr>
                            <?php foreach ($results['fournisseurs'] as $f) { ?>
                                <tr>
                                    <td><?= htmlentities($f['nom']) ?></td>
                                    <td><?= htmlentities($f['prenom']) ?></td>
                                    <td><?= htmlentities($f['telephone']) ?></td>
                                    <td><?= htmlentities($f['adresse']) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>

                    <?php if (!empty($results['articles'])) { ?>
                        <h3>Articles</h3>
                        <table class="mtable">
                            <tr><th>Nom</th><th>Prix unitaire</th><th>Quantité</th><th>Action</th></tr>
                            <?php foreach ($results['articles'] as $a) { ?>
                                <tr>
                                    <td><?= htmlentities($a['nom_article']) ?></td>
                                    <td><?= number_format($a['prix_unitaire'],0,',',' ') ?></td>
                                    <td><?= intval($a['quantite']) ?></td>
                                    <td><a href="vente.php?select_article_id=<?= $a['id'] ?>">Sélectionner</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>

                    <?php if (!empty($results['ventes'])) { ?>
                        <h3>Ventes</h3>
                        <table class="mtable">
                            <tr><th>Article</th><th>Client</th><th>Quantité</th><th>Prix</th><th>Date</th><th>Action</th></tr>
                            <?php foreach ($results['ventes'] as $v) { ?>
                                <tr>
                                    <td><?= htmlentities($v['nom_article']) ?></td>
                                    <td><?= htmlentities($v['nom'] . ' ' . $v['prenom']) ?></td>
                                    <td><?= intval($v['quantite']) ?></td>
                                    <td><?= number_format($v['prix'],0,',',' ') ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($v['date_vente'])) ?></td>
                                    <td><a href="recuVente.php?id=<?= $v['id'] ?>"><i class='bx bx-receipt'></i></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>

                <?php } ?>

            <?php } ?>
        </div>
    </div>
</div>
</section>

<?php include 'pied.php'; ?>
