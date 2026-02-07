# Gestion Stock DCLIC

Application web de gestion de stock et de ventes pour l'entreprise DCLIC.

## 📋 Fonctionnalités

### Gestion des Ventes
- Créer et gérer les ventes de produits
- Gestion du panier d'achat avec ajout/suppression d'articles
- Génération automatique de factures au format texte
- Annulation de factures avec restauration du stock
- Historique des ventes par facture

### Gestion des Articles
- Ajouter, modifier et supprimer des articles
- Gestion des catégories d'articles
- Suivi du stock en temps réel
- Validation du stock disponible lors des ventes

### Gestion des Clients
- Créer et modifier les informations des clients
- Historique des achats par client
- Recherche de clients

### Gestion des Fournisseurs
- Ajouter et modifier les fournisseurs
- Gestion des commandes aux fournisseurs

### Gestion Administrative
- Système RBAC (Role-Based Access Control) avec deux rôles :
  - **Directeur** : Accès complet à tous les modules
  - **Employer** : Accès limité (Dashboard, Ventes, Clients, Recherche)
- Gestion des employés (ajout/suppression)
- Analyses et rapports de ventes

### Rapport et Analyse
- Recherche globale dans l'application
- Reçu de vente
- Analyses des ventes

## 🛠️ Technologies Utilisées

- **Backend** : PHP 7.4.15
- **Base de Données** : MySQL/MariaDB 10.4.17
- **Frontend** : HTML5, CSS3, JavaScript
- **UI Framework** : Bootstrap
- **Icons** : Boxicons
- **Authentification** : Sessions PHP

## 📦 Installation

### Prérequis
- MAMP/LAMP/WAMP avec PHP 7.4+
- MySQL/MariaDB 10.4+
- Apache Web Server

### Étapes d'installation

1. **Cloner/télécharger le projet**
   ```bash
   cd /chemin/vers/htdocs
   git clone https://github.com/nioyojosue/gestion-app.git GestonStock
   cd GestonStock
   ```

2. **Configurer la base de données**
   - Créer une base de données `gestion_stock_dclic`
   - Modifier les identifiants dans [connexion/db.php](connexion/db.php) si nécessaire

3. **Initialiser la base de données**
   - Accéder à `http://localhost/GestonStock/setup.php`
   - Cela exécutera les migrations SQL automatiquement

4. **Vérifier l'admin**
   - Accéder à `http://localhost/GestonStock/check_admin.php`
   - Vérifie ou crée l'utilisateur admin par défaut

5. **Réparer les tables employé (si nécessaire)**
   - Accéder à `http://localhost/GestonStock/fix_employer_table.php`
   - Ajoute automatiquement les colonnes manquantes à la table employer

6. **Accéder à l'application**
   - URL : `http://localhost/GestonStock/`

## 👤 Identifiants par défaut

### Admin (Directeur)
- **Email** : admin@admin.com
- **Mot de passe** : admin123

## 📁 Structure du Projet

```
GestonStock/
├── authentification/          # Scripts d'authentification
│   ├── authentificationAdmin.php
│   └── authentificationEtudiant.php
├── connexion/                # Connexion à la base de données
│   ├── db.php               # Configuration PDO
│   ├── data_class.php       # Classe d'authentification
│   └── connexion.php
├── design/                   # Fichiers CSS
│   └── css/
│       ├── main.css
│       └── styles.css
├── factures/                # Factures générées (texte)
├── model/                   # Logique métier
│   ├── ajoutArticle.php
│   ├── ajoutCategorie.php
│   ├── ajoutClient.php
│   ├── ajoutCommande.php
│   ├── ajoutEmployer.php
│   ├── ajouterpanier.php
│   ├── ajoutFournisseur.php
│   ├── ajoutVente.php
│   ├── annuleFacture.php
│   ├── annuleVente.php
│   ├── connexion.php
│   ├── deconnexion.php
│   ├── facture_creer.php
│   ├── function.php         # Fonctions réutilisables
│   ├── modifArticle.php
│   ├── modifCategorie.php
│   ├── modifClient.php
│   ├── modifFournisseur.php
│   ├── panier_ajouter.php
│   ├── panier_clear.php
│   ├── panier_get.php
│   ├── panier_supprimer.php
│   ├── search_suggest.php
│   ├── supprimerEmployer.php
├── public/                  # Ressources publiques
│   ├── css/
│   │   └── style.css
│   └── images/
├── vue/                     # Pages/Templates
│   ├── analyse.php
│   ├── article.php
│   ├── categorie.php
│   ├── client.php
│   ├── commande.php
│   ├── dashboard.php
│   ├── employer.php
│   ├── entete.php           # En-tête avec navigation RBAC
│   ├── fournisseur.php
│   ├── pied.php
│   ├── recherche.php
│   ├── recuVente.php
│   └── vente.php
├── index.php               # Page d'authentification
├── setup.php              # Initialisation BD
├── check_admin.php        # Vérification admin
├── fix_employer_table.php # Réparation table employer
├── gestion_stock.sql      # Schéma initial
└── modifications_bdd.sql  # Migrations
```

## 🔐 Système RBAC

### Rôles et Permissions

| Module | Directeur | Employer |
|--------|-----------|----------|
| Dashboard | ✅ | ✅ |
| Ventes | ✅ | ✅ |
| Clients | ✅ | ✅ |
| Articles | ✅ | ❌ |
| Fournisseurs | ✅ | ❌ |
| Commandes | ✅ | ❌ |
| Catégories | ✅ | ❌ |
| Analyses | ✅ | ❌ |
| Employés | ✅ | ❌ |

## 🔧 Utilisation

### Connexion
1. Accéder à `http://localhost/GestonStock/`
2. Se connecter avec les identifiants d'admin ou d'employé

### Ajouter une Vente
1. Cliquer sur "Ventes" dans le menu
2. Rechercher et ajouter des articles au panier
3. Valider la quantité (min 1)
4. Créer la facture (enregistrement automatique en texte)

### Gestion des Employés (Admin)
1. Cliquer sur "Employés" dans le menu
2. Remplir le formulaire "Ajouter un employé"
3. L'employé reçoit ses identifiants pour se connecter

### Recherche Globale
- Utiliser la barre de recherche pour trouver articles, clients, etc.

## 📝 Notes de Développement

### Points importants
- Les factures sont générées au format texte dans le dossier `/factures/`
- Le stock est restauré lors de l'annulation de facture
- Les quantités négatives sont bloquées en frontend et backend
- Les employés ont un accès limité via le système RBAC

### Validation des données
- Email unique pour chaque utilisateur
- Quantité minimum = 1 pour les ventes
- Stock suffisant requis avant la vente
- Mot de passe sécurisé recommandé

## 🐛 Dépannage

### "Unknown column" lors de l'ajout d'employé
- Exécuter `http://localhost/GestonStock/fix_employer_table.php`

### Tables manquantes
- Exécuter `http://localhost/GestonStock/setup.php`

### Pas d'admin
- Exécuter `http://localhost/GestonStock/check_admin.php`

## 📞 Support

Pour toute question ou problème, consultez les fichiers d'erreur dans les logs Apache/PHP.

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👨‍💻 Auteurs

- Développement application de gestion de stock DCLIC

---

**Dernière mise à jour** : 7 février 2026
# gestion-app
