<?php
include 'entete.php';
// si on vient de la recherche avec sélection de client ou article
$select_client_id = null;
$select_article_id = null;
if (!empty($_GET['select_client_id'])) {
    $select_client_id = intval($_GET['select_client_id']);
}
if (!empty($_GET['select_article_id'])) {
    $select_article_id = intval($_GET['select_article_id']);
}

if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifVente.php" : "../model/ajoutVente.php" ?>" method="post">
                <input value="<?= !empty($_GET['id']) ?  $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                    <?php
                    $articles = getArticle();
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                    ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>" <?= (isset($select_article_id) && $select_article_id == $value['id']) ? 'selected' : '' ?>><?= $value['nom_article'] . " - " . $value['quantite'] . " disponibile" ?></option>
                    <?php

                        }
                    }

                    ?>
                </select>

                <label for="id_client">Client</label>
                <select name="id_client" id="id_client">
                    <?php
                    $clients = getClient();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>" <?= (isset($select_client_id) && $select_client_id == $value['id']) ? 'selected' : '' ?>><?= $value['nom'] . " " . $value['prenom'] ?></option>
                    <?php

                        }
                    }

                    ?>
                </select>

                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ?  $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ?  $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Veuillez saisir le prix">


                <button type="submit" style="background-color: green;">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>

        </div>
        <div class="box">
            <h3 style="color:dodgerblue; height: 100px; text-decoration: underline;">Panier</h3>
            <div id="panier-box">
                <!-- contenu chargé via AJAX -->
                <p>Chargement du panier...</p>
            </div>
            <div style="margin-top:8px;">
                <button type="button" onclick="finaliserFacture()"style="margin-left:8px; background-color:green;">Finaliser la facture</button>
                <button type="button" onclick="viderPanier()" style="margin-left:8px; background-color:orange;">Vider le panier</button>
            </div>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $vente = getVente();

                if (!empty($vente) && is_array($vente)) {
                    foreach ($vente as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_vente'])) ?></td>
                            <td>
                                <a href="recuVente.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                                <a onclick="annuleVente(<?= $value['id'] ?>, <?= $value['idArticle'] ?>, <?= $value['quantite'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
        </div>
    </div>

</div>
</section>

<?php
include 'pied.php';
?>
<script>
    function annuleVente(idVente, idArticle, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette vente ?")) {
            window.location.href = "../model/annuleVente.php?idVente=" + idVente + "&idArticle=" + idArticle + "&quantite=" + quantite
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>
<script>
    // si un client a été pré-sélectionné via get param, focus et scroller vers le champ client
    (function(){
        var selectClientId = <?= !empty($select_client_id) ? intval($select_client_id) : 'null' ?>;
        var selectArticleId = <?= !empty($select_article_id) ? intval($select_article_id) : 'null' ?>;
        if (selectClientId !== null) {
            var el = document.getElementById('id_client');
            if (el) {
                el.focus();
                try { el.scrollIntoView({behavior:'smooth', block:'center'}); } catch(e){}
            }
        }
        if (selectArticleId !== null) {
            var ael = document.getElementById('id_article');
            if (ael) {
                ael.focus();
                try { ael.scrollIntoView({behavior:'smooth', block:'center'}); } catch(e){}
                // set default quantity to 1 if empty and update price
                var quant = document.getElementById('quantite');
                if (quant && (!quant.value || quant.value == '')) quant.value = 1;
                // call setPrix to compute prix field (uses selected option data-prix)
                try { setPrix(); } catch(e){}
            }
        }
    })();
</script>
<script>
    // Panier AJAX functions
    function refreshPanier(){
        fetch('../model/panier_get.php')
        .then(r=>r.json())
        .then(j=>{
            if(!j.success){ document.getElementById('panier-box').innerHTML = '<p>Impossible de charger le panier</p>'; return; }
            renderPanier(j.data);
        }).catch(e=>{ console.error(e); document.getElementById('panier-box').innerHTML = '<p>Erreur</p>'; });
    }

    function renderPanier(data){
        const box = document.getElementById('panier-box');
        if(!data || !data.items || data.items.length===0){ box.innerHTML = '<p>Panier vide</p>'; return; }
        let html = '<table class="mtable"><tr><th>Article</th><th>Qté</th><th>PU</th><th>Total</th><th>Action</th></tr>';
        data.items.forEach(it=>{
            html += `<tr><td>${it.nom_article}</td><td>${it.quantite}</td><td>${it.prix_unitaire}</td><td>${it.total}</td><td><button style="background-color: red;" onclick="supprimerDuPanier(${it.id_article})">Supprimer</button></td></tr>`;
        });
        html += `<tr><td colspan="3"><strong>Total</strong></td><td colspan="2"><strong>${data.total}</strong></td></tr>`;
        html += '</table>';
        box.innerHTML = html;
    }

    function ajouterAuPanier(){
        const sel = document.getElementById('id_article');
        const quant = document.getElementById('quantite');
        const id = sel ? sel.value : null;
        const q = quant ? quant.value : 1;
        
        if(!id){ alert('Veuillez choisir un article'); return; }
        const fd = new FormData();
        fd.append('id_article', id);
        fd.append('quantite', q);
        fetch('../model/panier_ajouter.php', { method: 'POST', body: fd })
        .then(r=>r.json())
        .then(j=>{
            if(j.success){ refreshPanier(); } else { alert(j.error || 'Erreur ajout panier'); }
        }).catch(e=>{ console.error(e); alert('Erreur réseau'); });
    }

    function supprimerDuPanier(id_article){
        const fd = new FormData(); fd.append('id_article', id_article);
        fetch('../model/panier_supprimer.php', { method: 'POST', body: fd })
        .then(r=>r.json()).then(j=>{ if(j.success) refreshPanier(); else alert(j.error || 'Erreur'); })
        .catch(e=>{ console.error(e); alert('Erreur réseau'); });
    }

    function viderPanier(){
        if(!confirm('Vider le panier ?')) 
            
        return;
        fetch('../model/panier_clear.php', { method:'POST' })
        .then(r=>r.json()).then(j=>{ if(j.success) refreshPanier(); else alert(j.error||'Erreur'); })
        .catch(e=>{ console.error(e); alert('Erreur réseau'); });
    }

    function finaliserFacture(){
        const client = document.getElementById('id_client');
        if(!client || !client.value){
             alert('Veuillez sélectionner un client'); 
             return;
        }
        if(!confirm('Finaliser et créer la facture pour ce client ?')) 
            
        return;
        const fd = new FormData(); fd.append('id_client', client.value);
        fetch('../model/facture_creer.php', { method:'POST', body: fd })
        .then(r=>r.json())
        .then(j=>{
            if(j.success){
                    // open receipt in a new tab and refresh current page so ventes list shows the new ventes
                    try{
                        window.open(j.url, '_blank');
                    }catch(e){
                        // fallback to navigate if popup blocked
                        window.location.href = j.url;
                        return;
                    }
                    // reload current page to show updated ventes
                    setTimeout(function(){ window.location.reload(); }, 300);
                } else {
                alert(j.error || 'Erreur lors de la finalisation');
            }
        }).catch(e=>{ console.error(e); alert('Erreur réseau'); });
    }

    // initial load
    document.addEventListener('DOMContentLoaded', function(){ refreshPanier();
        // add quick "Ajouter au panier" button near the form submit
        try{
            var btn = document.createElement('button'); btn.type='button'; btn.textContent='Ajouter au panier';
            btn.addEventListener('click', ajouterAuPanier);
            var form = document.querySelector('.overview-boxes .box form');
            if(form){ form.querySelector('button[type=submit]').insertAdjacentElement('afterend', btn); }
        }catch(e){}
    });
</script>