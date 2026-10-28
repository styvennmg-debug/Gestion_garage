<?php
include("../connexion.php");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];

$sql = "INSERT INTO client(nom, prenom, telephone, adresse)
VALUES('$nom','$prenom','$telephone','$adresse')";

if(mysqli_query($conn, $sql)){
    header("Location: index.php");
}else{
    echo "Erreur : " . mysqli_error($conn);
}
?>