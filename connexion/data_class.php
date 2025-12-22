<?php include("db.php");

class data extends db {

    function adminLogin($email, $password) {
        $q = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            header("location: ../vue/article.php");
            exit; 
        } else {
            header("location: ../authentification/authentificationAdmin.php?msg=Email ou mot de passe incorrect !");
            exit; 
        }
    }
    
// user -------------------------------------------------------------------------------------------

   }