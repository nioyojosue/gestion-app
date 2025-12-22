<?php

include("data_class.php");

$email=$_POST['email'];
$password=$_POST['password'];

if($email==null||$password==null){
    $emailmsg="";
    $pasdmsg="";
    
    if($email==null){
        $emailmsg="Email vide !!";
    }
    if($password==null){
        $pasdmsg="mot de passe vide !!";
    }
    header("Location: ../authentification/authentificationEtudiant.php?msg=$emailmsg $pasdmsg");
}
elseif($email!=null&&$password!=null){
    $obj=new data();
    $obj->setconnection();
    $obj->userLogin($email,$password);

}