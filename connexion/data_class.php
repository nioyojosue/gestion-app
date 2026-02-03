<?php include("db.php");

class data extends db {

    function adminLogin($email, $password) {
        $q = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            session_start();
            $_SESSION['user'] = $email;
            $_SESSION['role'] = 'directeur';
            session_write_close();
            header("location: ../vue/dashboard.php");
            exit; 
        } else {
            header("location: ../authentification/authentificationAdmin.php?msg=Email ou mot de passe incorrect !");
            exit; 
        }
    }
    
    // user -------------------------------------------------------------------------------------------
   
    function userLogin($email, $password) {
        $q = "SELECT * FROM employer WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            session_start();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $email;
            $_SESSION['role'] = 'employer';
            session_write_close();
            header("location: ../vue/vente.php");
            exit;
        } else {
            header("location:../authentification/authentificationEtudiant.php?msg=Email ou mot de passe incorrect !");
            exit; 
        }
    }
}