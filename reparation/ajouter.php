<?php
include("../connexion.php");

$vehicules = mysqli_query($conn,"SELECT * FROM vehicule");
$mecaniciens = mysqli_query($conn,"SELECT * FROM mecanicien");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une réparation</title>
</head>
<body>

<h2>Ajouter une réparation</h2>

<form action="enregistrer.php" method="POST">

Description :<br>
<textarea name="description" required></textarea>

<br><br>

Date d'entrée :<br>
<input type="date" name="date_entree" required>

<br><br>

Date de sortie :<br>
<input type="date" name="date_sortie">

<br><br>

Coût :<br>
<input type="number" step="0.01" name="cout" required>

<br><br>

Statut :<br>

<select name="statut">

<option value="En attente">En attente</option>

<option value="En cours">En cours</option>

<option value="Terminée">Terminée</option>

</select>

<br><br>

Véhicule :<br>

<select name="id_vehicule">

<?php while($v=mysqli_fetch_assoc($vehicules)){ ?>

<option value="<?= $v['id'] ?>">

<?= $v['marque']." ".$v['modele']." - ".$v['immatriculation'] ?>

</option>

<?php } ?>

</select>

<br><br>

Mécanicien :<br>

<select name="id_mecanicien">

<?php while($m=mysqli_fetch_assoc($mecaniciens)){ ?>

<option value="<?= $m['id'] ?>">

<?= $m['nom'] ?>

</option>

<?php } ?>

</select>

<br><br>

<input type="submit" value="Enregistrer">

</form>

</body>
</html>