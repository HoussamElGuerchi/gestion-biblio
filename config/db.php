<?php

    try {

        $conn = new PDO("mysql:host=localhost;dbname=librairie", "root", "");

    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: ".$e->getMessage();
    }

?>