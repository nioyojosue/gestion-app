<?php

include_once '../model/function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="sidebar hidden-print">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">Ny_Design</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="dashboard.php" ? "active" : "" ?> ">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="vente.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="vente.php" ? "active" : "" ?> ">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <li>
                <a href="client.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="client.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Client</span>
                </a>
            </li>
            <li>
                <a href="article.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="article.php" ? "active" : "" ?> ">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Articles</span>
                </a>
            </li>
            <li>
                <a href="fournisseur.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="fournisseur.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Fournisseur</span>
                </a>
            </li>
            <li>
                <a href="commande.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="commande.php" ? "active" : "" ?> ">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li>
                <a href="categorie.php"  class="<?php echo basename($_SERVER['PHP_SELF'])=="categorie.php" ? "active" : "" ?> ">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Catégorie</span>
                </a>
            </li>
            <li>
                <a href="analyse.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="analyse.php" ? "active" : "" ?> ">
                    <i class="bx bx-pie-chart-alt-2"></i>
                    <span class="links_name">Analyses</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Stock de josue</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-book-alt"></i>
                    <span class="links_name">Toutes les commmandes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Utilisateur</span>
                </a>
            </li>
            <!-- <li>
          <a href="#">
            <i class="bx bx-message" ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart" ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li> -->
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="links_name">Configuration</span>
                </a>
            </li>
            <li class="log_out">
                <a href="#">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">
                    <?php
                    echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                    ?>
                </span>
            </div>
            <div class="search-box" style="position:relative;">
                <form id="top-search-form" action="recherche.php" method="get" style="display:flex; align-items:center; gap:6px;">
                    <input id="top-search-input" name="q" type="text" autocomplete="off" placeholder="Recherche (client, vente, fournisseur)..." value="<?= isset($_GET['q']) ? htmlentities($_GET['q']) : '' ?>" />
                    <select id="top-search-scope" name="scope" style="padding:6px;">
                        <option value="all" <?= (isset($_GET['scope']) && $_GET['scope']=='all')? 'selected' : '' ?>>Tout</option>
                        <option value="client" <?= (isset($_GET['scope']) && $_GET['scope']=='client')? 'selected' : '' ?>>Client</option>
                        <option value="article" <?= (isset($_GET['scope']) && $_GET['scope']=='article')? 'selected' : '' ?>>Article</option>
                        <option value="vente" <?= (isset($_GET['scope']) && $_GET['scope']=='vente')? 'selected' : '' ?>>Vente</option>
                        <option value="fournisseur" <?= (isset($_GET['scope']) && $_GET['scope']=='fournisseur')? 'selected' : '' ?>>Fournisseur</option>
                    </select>
                    <button type="submit" style="background:transparent; border:none; color:#333; cursor:pointer;"><i class="bx bx-search"></i></button>
                </form>

                <div id="search-suggestions" style="position:absolute; top:38px; left:0; right:0; z-index:9999; display:none; background:#fff; border:1px solid #ddd; border-radius:4px; max-height:320px; overflow:auto; box-shadow:0 6px 18px rgba(0,0,0,0.08);">
                    <!-- suggestions injectées ici -->
                </div>
                <style>
                    #search-suggestions .suggestion {padding:8px 12px; cursor:pointer; border-bottom:1px solid #f2f2f2}
                    #search-suggestions .suggestion:hover, #search-suggestions .suggestion.active {background:#f5f7fb}
                    #search-suggestions .type {font-size:11px; color:#777; margin-left:8px}
                </style>
                <script>
                    (function(){
                        const input = document.getElementById('top-search-input');
                        const scopeEl = document.getElementById('top-search-scope');
                        const suggestionsBox = document.getElementById('search-suggestions');
                        let timer = null;
                        let items = [];
                        let index = -1;

                        function render(list){
                            items = list;
                            index = -1;
                            if(!list || list.length===0){ suggestionsBox.style.display='none'; suggestionsBox.innerHTML=''; return; }
                            suggestionsBox.style.display='block';
                            suggestionsBox.innerHTML = list.map((s,i)=>{
                                return `<div class="suggestion" data-i="${i}" data-link="${s.link}">
                                    <strong>${s.label}</strong>
                                    <span class="type">${s.type}</span>
                                </div>`;
                            }).join('');
                        }

                        function fetchSuggest(q){
                            if(!q || q.trim().length<1){ render([]); return; }
                            const scope = scopeEl.value || 'all';
                            fetch('../model/search_suggest.php?q='+encodeURIComponent(q)+'&scope='+encodeURIComponent(scope))
                                .then(r=>r.json())
                                .then(data=>{ render(data); })
                                .catch(e=>{ console.error(e); render([]); });
                        }

                        input.addEventListener('input', function(e){
                            clearTimeout(timer);
                            timer = setTimeout(()=> fetchSuggest(this.value), 220);
                        });

                        input.addEventListener('keydown', function(e){
                            const len = suggestionsBox.querySelectorAll('.suggestion').length;
                            if(len===0) return;
                            if(e.key === 'ArrowDown'){
                                e.preventDefault(); index = Math.min(index+1, len-1); updateActive();
                            } else if(e.key === 'ArrowUp'){
                                e.preventDefault(); index = Math.max(index-1, 0); updateActive();
                            } else if(e.key === 'Enter'){
                                const active = suggestionsBox.querySelector('.suggestion.active');
                                if(active){
                                    // if suggestion points to vente.php and we're already on vente.php, insert without reloading
                                    const link = active.getAttribute('data-link');
                                    handleSuggestionNavigation(link);
                                    e.preventDefault();
                                }
                            } else if(e.key === 'Escape'){
                                render([]);
                            }
                        });

                        function updateActive(){
                            const nodes = suggestionsBox.querySelectorAll('.suggestion');
                            nodes.forEach(n=>n.classList.remove('active'));
                            if(index>=0 && nodes[index]){
                                nodes[index].classList.add('active');
                                // scroll into view
                                const rect = nodes[index].getBoundingClientRect();
                                nodes[index].scrollIntoView({block:'nearest'});
                            }
                        }

                        suggestionsBox.addEventListener('click', function(ev){
                            const node = ev.target.closest('.suggestion');
                            if(!node) return;
                            const link = node.getAttribute('data-link');
                            if(!link) return;
                            handleSuggestionNavigation(link);
                        });

                        function handleSuggestionNavigation(link){
                            try{
                                // build absolute URL to parse params (works for relative links)
                                const url = new URL(link, window.location.origin + window.location.pathname);
                                const pathname = url.pathname || '';
                                const isVenteLink = pathname.endsWith('vente.php') || url.href.indexOf('vente.php')!==-1;

                                // if we are on vente.php, intercept selections that target vente.php and fill the form in-place
                                const currentIsVente = window.location.pathname.endsWith('vente.php') || window.location.href.indexOf('vente.php')!==-1;
                                if(isVenteLink && currentIsVente){
                                    const params = new URLSearchParams(url.search);
                                    // handle select_article_id and select_client_id
                                    if(params.has('select_article_id')){
                                        const id = params.get('select_article_id');
                                        const sel = document.getElementById('id_article');
                                        if(sel){
                                            sel.value = id;
                                            // trigger change so setPrix runs
                                            sel.dispatchEvent(new Event('change', {bubbles:true}));
                                            // ensure quantity present and set to 1 if empty
                                            const quant = document.getElementById('quantite');
                                            if(quant && (!quant.value || quant.value=='') ) quant.value = 1;
                                            // recompute price
                                            try{ setPrix(); } catch(e){}
                                            try{ sel.focus(); sel.scrollIntoView({behavior:'smooth', block:'center'}); } catch(e){}
                                        }
                                    }
                                    if(params.has('select_client_id')){
                                        const id = params.get('select_client_id');
                                        const sel = document.getElementById('id_client');
                                        if(sel){
                                            sel.value = id;
                                            try{ sel.focus(); sel.scrollIntoView({behavior:'smooth', block:'center'}); } catch(e){}
                                        }
                                    }
                                    // hide suggestions
                                    render([]);
                                    return;
                                }

                                // fallback: navigate as before
                                window.location.href = link;
                            }catch(err){
                                // if URL parsing fails, just navigate
                                window.location.href = link;
                            }
                        }

                        // close on outside click
                        document.addEventListener('click', function(e){
                            if(!e.target.closest('#search-suggestions') && !e.target.closest('#top-search-input')){
                                suggestionsBox.style.display='none';
                            }
                        });
                    })();
                </script>
            </div>
            <div class="profile-details">
                <!-- <img src="profile.jpg" alt=""> -->
                <span class="admin_name">Josue</span>
                <i class="bx bx-chevron-down"></i>
            </div>
    
        </nav>