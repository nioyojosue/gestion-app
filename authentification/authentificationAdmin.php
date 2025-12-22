<!DOCTYPE html>
<html>

<head>
    <title>Page de Connexion Directeur</title>
    <link rel="stylesheet" type="text/css" href="../design/css/styles.css">
    <div class="container"><a href='../index.php'><img class="imglogo" src='../logo.png'></a></div>
</head>

<body>
    <h2>Connexion Directeur</h2>
    <form action='../connexion/connexion_admin.php' method='post'>
        <label>Adresse e-mail:</label>
        <br>
        <input type='text' name='email' placeholder="votre email *" required><br><label>Mot de passe:</label>
        <br>
        <input type='password' name='password' placeholder="votre mot de passe *" required>
        <br>
        <input type='submit' value='Se Connecter'><br>
    </form><?php $msg=$_GET['msg'];

    if($msg !=null) {
        echo "<div id='msg' >";
        echo '<label id="monLabel">';
        echo "$msg";
        echo "</label>";
        echo "</div>";
    }

    ?>
</body>

</html>