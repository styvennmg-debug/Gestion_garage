<?php

include("../connexion.php");

$description = $_POST['description'];
$date_entree = $_POST['date_entree'];
$date_sortie = $_POST['date_sortie'];
$cout = $_POST['cout'];
$statut = $_POST['statut'];
$id_vehicule = $_POST['id_vehicule'];
$id_mecanicien = $_POST['id_mecanicien'];

$sql = "INSERT INTO reparation
(description,date_entree,date_sortie,cout,statut,id_vehicule,id_mecanicien)

VALUES

('$description',
'$date_entree',
'$date_sortie',
'$cout',
'$statut',
'$id_vehicule',
'$id_mecanicien')";

mysqli_query($conn,$sql);

header("Location:index.php");

?>