<?php
include 'entete.php';

// Utilise les fonctions existantes
$recentVentes = getLastVente();
$topArticles = getMostVente();
$ca = getCA();
$nbVentes = getAllVente();

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <h2>Analyse des ventes récentes</h2>
            <p>Chiffre d'affaire total: <strong><?= !empty($ca['prix']) ? number_format($ca['prix'], 0, ',', ' ') : '0' ?> FCFA</strong></p>
            <p>Nombre de ventes (actives): <strong><?= !empty($nbVentes['nbre']) ? $nbVentes['nbre'] : 0 ?></strong></p>
        </div>
        <div class="box">
            <h3>Top articles (par chiffre généré)</h3>
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>CA</th>
                </tr>
                <?php if (!empty($topArticles) && is_array($topArticles)) {
                    foreach ($topArticles as $art) {
                ?>
                    <tr>
                        <td><?= $art['nom_article'] ?></td>
                        <td><?= number_format($art['prix'], 0, ',', ' ') ?></td>
                    </tr>
                <?php }
                } else { ?>
                    <tr><td colspan="2">Aucun résultat</td></tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="box" style="margin-top:20px;">
        <h3>Ventes récentes</h3>
        <table class="mtable">
            <tr>
                <th>Article</th>
                <th>Client</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($recentVentes) && is_array($recentVentes)) {
                foreach ($recentVentes as $v) {
            ?>
                <tr>
                    <td><?= $v['nom_article'] ?></td>
                    <td><?= $v['nom'] . " " . $v['prenom'] ?></td>
                    <td><?= $v['quantite'] ?></td>
                    <td><?= number_format($v['prix'], 0, ',', ' ') ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($v['date_vente'])) ?></td>
                    <td>
                        <a href="recuVente.php?id=<?= $v['id'] ?>" title="Voir reçu"><i class='bx bx-receipt'></i></a>
                    </td>
                </tr>
            <?php }
            } else { ?>
                <tr><td colspan="6" style="text-align:center;">Aucune vente récente</td></tr>
            <?php } ?>
        </table>
    </div>

</div>
</section>

<?php include 'pied.php'; ?>

<script>
// petit script pour csv export (optionnel)
function exportRecentSalesCSV() {
    const rows = [];
    const table = document.querySelector('.box table.mtable');
    if (!table) return alert('Table introuvable');
    for (let r of table.querySelectorAll('tr')) {
        const cols = Array.from(r.children).map(td => td.innerText.replace(/\s+/g,' '));
        rows.push(cols.join(','));
    }
    const csv = rows.join('\n');
    const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = 'ventes_recentes.csv'; document.body.appendChild(a); a.click(); a.remove();
}
</script>
