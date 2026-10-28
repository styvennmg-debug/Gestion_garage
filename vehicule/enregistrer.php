<?php

include("../connexion.php");

$marque = $_POST['marque'];
$modele = $_POST['modele'];
$immatriculation = $_POST['immatriculation'];
$annee = $_POST['annee'];
$couleur = $_POST['couleur'];
$kilometrage = $_POST['kilometrage'];
$id_client = $_POST['id_client'];

$sql = "INSERT INTO vehicule
(marque,modele,immatriculation,annee,couleur,kilometrage,id_client)

VALUES

('$marque','$modele','$immatriculation','$annee','$couleur','$kilometrage','$id_client')";

mysqli_query($conn,$sql);

header("Location:index.php");

?>