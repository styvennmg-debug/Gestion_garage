<?php
include("../connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un mécanicien</title>
</head>
<body>

<h2>Ajouter un mécanicien</h2>

<form action="enregistrer.php" method="POST">

Nom :
<input type="text" name="nom" required><br><br>

Spécialité :
<input type="text" name="specialite" required><br><br>

Téléphone :
<input type="text" name="telephone" required><br><br>

<input type="submit" value="Enregistrer">

</form>

</body>
</html>