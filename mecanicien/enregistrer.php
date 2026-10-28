<?php

include("../connexion.php");

$nom = $_POST['nom'];
$specialite = $_POST['specialite'];
$telephone = $_POST['telephone'];

$sql = "INSERT INTO mecanicien(nom,specialite,telephone)

VALUES

('$nom','$specialite','$telephone')";

mysqli_query($conn,$sql);

header("Location:index.php");

?>