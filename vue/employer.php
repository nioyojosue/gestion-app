<?php
include 'entete.php';
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <h3>Ajouter un nouvel employé</h3>
            <form action="../model/ajoutEmployer.php" method="post">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Nom de l'employé" required>

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom de l'employé" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email de l'employé" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>

                <label for="telephone">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" placeholder="Téléphone">

                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" placeholder="Adresse">

                <button type="submit" style="background-color: green;">Ajouter l'employé</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
            </form>
        </div>

        <div class="box">
            <h3>Liste des employés</h3>
            <table class="mtable">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
                <?php
                include_once '../model/connexion.php';
                
                $sql = "SELECT * FROM employer";
                $req = $connexion->prepare($sql);
                $req->execute();
                $employes = $req->fetchAll();

                if (!empty($employes) && is_array($employes)) {
                    foreach ($employes as $employe) {
                ?>
                        <tr>
                            <td><?= htmlentities($employe['nom']) ?></td>
                            <td><?= htmlentities($employe['prenom']) ?></td>
                            <td><?= htmlentities($employe['email']) ?></td>
                            <td><?= htmlentities($employe['telephone'] ?? '') ?></td>
                            <td><?= htmlentities($employe['adresse'] ?? '') ?></td>
                            <td>
                                <a href="employer.php?id=<?= $employe['id'] ?>"><i class='bx bx-edit'></i></a>
                                <a onclick="if(confirm('Confirmer la suppression ?')) window.location.href='../model/supprimerEmployer.php?id=<?= $employe['id'] ?>';" style="color: red;"><i class='bx bx-trash'></i></a>
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
