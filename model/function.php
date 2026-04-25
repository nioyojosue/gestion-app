<?php
include 'connexion.php';

function getArticle($id = null, $searchDATA = array(), $limit = null, $offset = null)
{
    $pagination = "";
    if (!empty($limit) && (!empty($offset) || $offset == 0)) {
        $pagination = " LIMIT $limit OFFSET $offset";
    }
    if (!empty($id)) {
        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images
        FROM article AS a, categorie_article AS c WHERE a.id=? AND c.id=a.id_categorie";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%' ";
        if (!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie ";
        if (!empty($quantite)) $search .= " AND a.quantite = $quantite ";
        if (!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire ";
        if (!empty($date_fabrication)) $search .= " AND DATE(a.date_fabrication) = '$date_fabrication' ";
        if (!empty($date_expiration)) $search .= " AND DATE(a.date_expiration) = '$date_expiration' ";

        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $search $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    } else {
        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetchAll();
    }
}

function countArticle($searchDATA = array())
{

   if (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%' ";
        if (!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie ";
        if (!empty($quantite)) $search .= " AND a.quantite = $quantite ";
        if (!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire ";
        if (!empty($date_fabrication)) $search .= " AND DATE(a.date_fabrication) = '$date_fabrication' ";
        if (!empty($date_expiration)) $search .= " AND DATE(a.date_expiration) = '$date_expiration' ";

        $sql = "SELECT COUNT(*) AS total FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $search";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetch();
    } else {
        $sql = "SELECT COUNT(*) AS total 
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie";
        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetch();
    }
}

function getClient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getVente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchAll();
    }
}


function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getCommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id AND co.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, a.id AS idArticle
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getAllCommande()
{
    $sql = "SELECT COUNT(*) AS nbre FROM commande";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE etat=?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();
}

function getAllArticle()
{
    $sql = "SELECT COUNT(*) AS nbre FROM article";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getLastVente()
{

    $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        ORDER BY date_vente DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getMostVente()
{

    $sql = "SELECT nom_article, SUM(prix) AS prix
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        GROUP BY a.id
        ORDER BY SUM(prix) DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getCategorie($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM categorie_article WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie_article";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

// ----------------- Fonctions de recherche -----------------

function searchClientByName($q)
{
    $sql = "SELECT * FROM client WHERE nom LIKE ? OR prenom LIKE ? LIMIT 50";
    $req = $GLOBALS['connexion']->prepare($sql);
    $like = "%$q%";
    $req->execute(array($like, $like));
    return $req->fetchAll();
}

function searchFournisseurByName($q)
{
    $sql = "SELECT * FROM fournisseur WHERE nom LIKE ? OR prenom LIKE ? LIMIT 50";
    $req = $GLOBALS['connexion']->prepare($sql);
    $like = "%$q%";
    $req->execute(array($like, $like));
    return $req->fetchAll();
}

function searchVenteByKeyword($q)
{
    // recherche par nom article, nom client ou id
    $sql = "SELECT v.id, a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente
            FROM vente v
            JOIN article a ON v.id_article = a.id
            JOIN client c ON v.id_client = c.id
            WHERE a.nom_article LIKE ? OR c.nom LIKE ? OR c.prenom LIKE ? OR v.id = ?
            ORDER BY v.date_vente DESC LIMIT 200";

    $req = $GLOBALS['connexion']->prepare($sql);
    $like = "%$q%";
    // if q is numeric, pass as id
    $id = is_numeric($q) ? intval($q) : 0;
    $req->execute(array($like, $like, $like, $id));
    return $req->fetchAll();
}

function searchArticleByName($q)
{
    $sql = "SELECT id, nom_article, prix_unitaire, quantite FROM article WHERE nom_article LIKE ? LIMIT 50";
    $req = $GLOBALS['connexion']->prepare($sql);
    $like = "%$q%";
    $req->execute(array($like));
    return $req->fetchAll();
}

// ----------------- Panier (session) et Facture multi-article -----------------

function panierSession_add($articleId, $quantite)
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    $article = getArticle($articleId);
    if (empty($article)) return array('success' => false, 'error' => 'Article introuvable');
    $available = intval($article['quantite']);
    $q = intval($quantite);
    if ($q <= 0) return array('success' => false, 'error' => 'Quantité invalide');
    if ($q > $available) return array('success' => false, 'error' => 'Quantité demandée supérieure au stock');

    if (!isset($_SESSION['panier'])) $_SESSION['panier'] = array();
    // store prix_unitaire snapshot
    $_SESSION['panier'][$articleId] = array(
        'id_article' => $articleId,
        'nom_article' => $article['nom_article'],
        'quantite' => $q,
        'prix_unitaire' => $article['prix_unitaire']
    );

    return array('success' => true);
}

function panierSession_remove($articleId)
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['panier'][$articleId])) {
        unset($_SESSION['panier'][$articleId]);
    }
    return array('success' => true);
}

function panierSession_get()
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    $items = array();
    $total = 0;
    if (!empty($_SESSION['panier']) && is_array($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $it) {
            $lineTotal = floatval($it['prix_unitaire']) * intval($it['quantite']);
            $items[] = array(
                'id_article' => $it['id_article'],
                'nom_article' => $it['nom_article'],
                'quantite' => $it['quantite'],
                'prix_unitaire' => $it['prix_unitaire'],
                'total' => $lineTotal
            );
            $total += $lineTotal;
        }
    }
    return array('items' => $items, 'total' => $total);
}

function panierSession_clear()
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    unset($_SESSION['panier']);
    return array('success' => true);
}

function creerFactureFromPanier($id_client)
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['panier']) || !is_array($_SESSION['panier'])) return array('success' => false, 'error' => 'Panier vide');
    // validate client
    $client = getClient($id_client);
    if (empty($client)) return array('success' => false, 'error' => 'Client introuvable');

    $conn = $GLOBALS['connexion'];
    try {
        $conn->beginTransaction();

    // create facture (générer un numéro de facture pour éviter les colonnes NOT NULL)
    // Insérer aussi un montant_total initial (0) pour éviter les erreurs si la colonne est NOT NULL
    $num_facture = 'FAC-'.date('YmdHis').'-'.mt_rand(100,999);
    
    // Récupérer les informations de l'utilisateur connecté
    $email_user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Inconnu';
    $role_user = isset($_SESSION['role']) ? $_SESSION['role'] : 'employer';
    $id_employer = null;
    
    // Si c'est un employé, récupérer son ID
    if ($role_user == 'employer' && !empty($email_user)) {
        $sql_emp = "SELECT id FROM employer WHERE email = ?";
        $stmt_emp = $conn->prepare($sql_emp);
        $stmt_emp->execute(array($email_user));
        $emp = $stmt_emp->fetch(PDO::FETCH_ASSOC);
        if ($emp) {
            $id_employer = $emp['id'];
        }
    }
    
    $sql = "INSERT INTO facture (id_client, date_facture, num_facture, montant_total, id_employer, email_user, role_user) VALUES (?, NOW(), ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id_client, $num_facture, 0, $id_employer, $email_user, $role_user));
        $id_facture = $conn->lastInsertId();

        $montant_total = 0;

        // insert ventes
        foreach ($_SESSION['panier'] as $it) {
            $articleId = intval($it['id_article']);
            $qty = intval($it['quantite']);
            $prix_unitaire = floatval($it['prix_unitaire']);

            // re-check stock
            $article = getArticle($articleId);
            if (empty($article)) throw new Exception('Article introuvable id='.$articleId);
            if ($article['quantite'] < $qty) throw new Exception('Stock insuffisant pour '.$article['nom_article']);

            $prix = $qty * $prix_unitaire;

            $sql = "INSERT INTO vente (id_article, id_client, quantite, prix, id_facture) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($articleId, $id_client, $qty, $prix, $id_facture));

            // decrement stock
            $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($qty, $articleId));

            $montant_total += $prix;
        }

        // update facture montant
        $sql = "UPDATE facture SET montant_total = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($montant_total, $id_facture));

        $conn->commit();
        // clear session panier
        unset($_SESSION['panier']);

        // Générer automatiquement le fichier facture
        require_once __DIR__ . '/sauvegarder_facture_pdf.php';
        $pdf_result = genererPDFFacture($id_facture);

        return array('success' => true, 'id_facture' => $id_facture, 'montant_total' => $montant_total, 'pdf_saved' => $pdf_result['success']);

    } catch (Exception $e) {
        $conn->rollBack();
        return array('success' => false, 'error' => $e->getMessage());
    }
}

function getFacture($id_facture)
{
    $sql = "SELECT f.id, f.id_client, f.date_facture, f.montant_total, f.num_facture, f.id_employer, f.email_user, f.role_user,
            c.nom, c.prenom, c.telephone, c.adresse,
            e.nom as employer_nom, e.prenom as employer_prenom
        FROM facture f
        LEFT JOIN client c ON f.id_client = c.id
        LEFT JOIN employer e ON f.id_employer = e.id
        WHERE f.id = ?";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array($id_facture));
    return $req->fetch();
}

function getArticlesFacture($id_facture)
{
    $sql = "SELECT v.id, v.id_article, a.nom_article, v.quantite, v.prix, a.prix_unitaire
        FROM vente v
        LEFT JOIN article a ON v.id_article = a.id
        WHERE v.id_facture = ?";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array($id_facture));
    return $req->fetchAll();
}

function getFactures()
{
    $sql = "SELECT f.id, f.id_client, f.date_facture, f.montant_total, f.num_facture, c.nom, c.prenom,
            COUNT(v.id) AS nombre_articles
        FROM facture f
        LEFT JOIN client c ON f.id_client = c.id
        LEFT JOIN vente v ON f.id = v.id_facture
        GROUP BY f.id
        ORDER BY f.date_facture DESC";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}
