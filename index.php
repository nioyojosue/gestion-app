<!DOCTYPE html>
<html>

<head>
    <title>Page de Connexion</title>
    <link rel="stylesheet" type="text/css" href="design/css/styles.css">
    <a href='index.php'><img src='logo.png' class="imglogo" alt='Logo' class='logo'></a>

</head>

<body>
    <h2>Choix de Connexion</h2>
    <form action='' method='post'>
        <input type='radio' name='choix_connexion' value='Etudiant'> Employé<br>
        <input type='radio' name='choix_connexion' value='Admin'> Directeur<br>
        <br>
        <input type='submit' value='Choisir'>
    </form>
    <?php
if(isset($_POST['choix_connexion'])) {
    $choix = $_POST['choix_connexion'];
    if($choix != "Etudiant" && $choix != "Admin") {
        echo "Choix invalide.";
    } else {
        header("Location:authentification/authentification".$choix.".php");    
    }
}
?>
</body>

</html>