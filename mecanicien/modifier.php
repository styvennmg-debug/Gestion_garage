<?php
include("../connexion.php");

$id = $_GET['id'];

$resultat = mysqli_query($conn, "SELECT * FROM mecanicien WHERE id=$id");
$mecanicien = mysqli_fetch_assoc($resultat);

if(isset($_POST['modifier'])){

    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $telephone = $_POST['telephone'];

    $sql = "UPDATE mecanicien SET
            nom='$nom',
            specialite='$specialite',
            telephone='$telephone'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un mécanicien</title>
</head>
<body>

<h2>Modifier un mécanicien</h2>

<form method="POST">

    Nom :<br>
    <input type="text" name="nom" value="<?php echo $mecanicien['nom']; ?>" required>
    <br><br>

    Spécialité :<br>
    <input type="text" name="specialite" value="<?php echo $mecanicien['specialite']; ?>" required>
    <br><br>

    Téléphone :<br>
    <input type="text" name="telephone" value="<?php echo $mecanicien['telephone']; ?>" required>
    <br><br>

    <input type="submit" name="modifier" value="Modifier">

</form>

<br>

<a href="index.php">Retour à la liste</a>

</body>
</html>