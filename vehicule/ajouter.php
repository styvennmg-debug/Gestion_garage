<?php
include("../connexion.php");

$clients = mysqli_query($conn, "SELECT * FROM client");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un véhicule</title>
</head>
<body>

<h2>Ajouter un véhicule</h2>

<form action="enregistrer.php" method="POST">

Marque :
<input type="text" name="marque" required><br><br>

Modèle :
<input type="text" name="modele" required><br><br>

Immatriculation :
<input type="text" name="immatriculation" required><br><br>

Année :
<input type="number" name="annee" required><br><br>

Couleur :
<input type="text" name="couleur" required><br><br>

Kilométrage :
<input type="number" name="kilometrage" required><br><br>

Client :

<select name="id_client">

<?php
while($c = mysqli_fetch_assoc($clients)){
?>

<option value="<?php echo $c['id']; ?>">
<?php echo $c['nom']." ".$c['prenom']; ?>
</option>

<?php
}
?>

</select>

<br><br>

<input type="submit" value="Enregistrer">

</form>

</body>
</html>