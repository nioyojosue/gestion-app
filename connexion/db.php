<?php
class db{
protected $connection;

function setconnection(){
    try{
        $this->connection=new PDO("mysql:host=localhost; dbname=gestion_stock_dclic","root","root");
        //echo "Done";
    }catch(PDOException $e){
        echo "Erreur de connextion au serveur ";
        //die();

    }
}

}