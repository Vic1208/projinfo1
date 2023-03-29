database5.php
<?php

    define('HOST', 'localhost');
    define('DB_NAME','base_de_donnees');
    define('USER','root');
    define('PASS','');

    $nom = $_POST['nom'];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
   

    try{
        //On se connecte à la BDD
        $dbco = new PDO('mysql:host=localhost;dbname=base_de_donnees;charset=utf8','root','');
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO base_de_donnees(nom, prenom, email)
            VALUES(:nom, :prenom, :email)");
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':email',$email);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:index.html");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>

