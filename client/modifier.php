<?php
include("../connexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM client WHERE id=$id";
$resultat = mysqli_query($conn, $sql);

$client = mysqli_fetch_assoc($resultat);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un client</title>
</head>
<body>

<h2>Modifier un client</h2>

<form action="modifier.php?id=<?php echo $id; ?>" method="POST">

Nom :
<input type="text" name="nom" value="<?php echo $client['nom']; ?>" required><br><br>

Prénom :
<input type="text" name="prenom" value="<?php echo $client['prenom']; ?>" required><br><br>

Téléphone :
<input type="text" name="telephone" value="<?php echo $client['telephone']; ?>" required><br><br>

Adresse :
<input type="text" name="adresse" value="<?php echo $client['adresse']; ?>" required><br><br>

<input type="submit" name="modifier" value="Modifier">

</form>

</body>
</html>

<?php

if(isset($_POST['modifier'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    $sql = "UPDATE client
            SET nom='$nom',
                prenom='$prenom',
                telephone='$telephone',
                adresse='$adresse'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>