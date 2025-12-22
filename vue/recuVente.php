<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $vente = getVente($_GET['id']);
}

// support pour facture multi-article
$facture = null;
$articlesFacture = array();
if (!empty($_GET['id_facture'])) {
    $facture = getFacture(intval($_GET['id_facture']));
    if ($facture) {
        $articlesFacture = getArticlesFacture(intval($_GET['id_facture']));
    }
}

?>
<div class="home-content">


    <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"> <i class='bx bx-printer'></i> Imprimer</button>
    <div class="page">
        <div class="cote-a-cote">
            <h2>N-design Stock</h2>
            <div>
                <?php if ($facture) : ?>
                    <p>Facture N° #:2025 <?= $facture['id'] ?> </p>
                    <p>Date: <?= date('d/m/Y H:i:s', strtotime($facture['date_facture'])) ?> </p>
                <?php else: ?>
                    <p>Reçu N° #: <?= $vente['id'] ?> </p>
                    <p>Date: <?= date('d/m/Y H:i:s', strtotime($vente['date_vente'])) ?> </p>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Nom :</p>
                <p><?= $facture ? ($facture['nom'] . " " . $facture['prenom']) : ($vente['nom'] . " " . $vente['prenom']) ?></p>
            </div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Tel :</p>
                <p><?= $facture ? $facture['telephone'] : $vente['telephone'] ?></p>
            </div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Adresse :</p>
                <p><?= $facture ? $facture['adresse'] : $vente['adresse'] ?></p>
            </div>
        </div>
        
        <br>
        
        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>

            <?php if ($facture && !empty($articlesFacture)) : ?>
                <?php foreach ($articlesFacture as $a) : ?>
                    <tr>
                        <td><?= $a['nom_article'] ?></td>
                        <td><?= $a['quantite'] ?></td>
                        <td><?= $a['prix_unitaire'] ?></td>
                        <td><?= $a['prix'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total FCFA</strong></td>
                    <td><strong><?= $facture['montant_total'] ?></strong></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td><?= $vente['nom_article'] ?></td>
                    <td><?= $vente['quantite'] ?></td>
                    <td><?= $vente['prix_unitaire'] ?></td>
                    <td><?= $vente['prix'] ?></td>
                </tr>
            <?php endif; ?>

        </table>
    </div>


</div>
</section>

<?php
include 'pied.php';
?>
<script>

    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
  
    
</script>