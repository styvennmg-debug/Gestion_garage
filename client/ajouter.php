<?php
include("../connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client</title>
</head>
<body>

<h2>Ajouter un client</h2>

<form action="enregistrer.php" method="POST">

    Nom :
    <input type="text" name="nom" required><br><br>

    Prénom :
    <input type="text" name="prenom" required><br><br>

    Téléphone :
    <input type="text" name="telephone" required><br><br>

    Adresse :
    <input type="text" name="adresse" required><br><br>

    <input type="submit" value="Enregistrer">

</form>

<br>

<a href="index.php">Retour</a>

</body>
</html>