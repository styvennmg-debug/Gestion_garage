<?php
include("../connexion.php");

$id = $_GET['id'];

$vehicule = mysqli_query($conn,"SELECT * FROM vehicule WHERE id=$id");
$data = mysqli_fetch_assoc($vehicule);

$clients = mysqli_query($conn,"SELECT * FROM client");

if(isset($_POST['modifier'])){

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];
    $kilometrage = $_POST['kilometrage'];
    $id_client = $_POST['id_client'];

    $sql = "UPDATE vehicule SET
    marque='$marque',
    modele='$modele',
    immatriculation='$immatriculation',
    annee='$annee',
    couleur='$couleur',
    kilometrage='$kilometrage',
    id_client='$id_client'
    WHERE id=$id";

    mysqli_query($conn,$sql);

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un véhicule</title>
</head>
<body>

<h2>Modifier un véhicule</h2>

<form method="POST">

Marque :
<input type="text" name="marque" value="<?php echo $data['marque']; ?>" required><br><br>

Modèle :
<input type="text" name="modele" value="<?php echo $data['modele']; ?>" required><br><br>

Immatriculation :
<input type="text" name="immatriculation" value="<?php echo $data['immatriculation']; ?>" required><br><br>

Année :
<input type="number" name="annee" value="<?php echo $data['annee']; ?>" required><br><br>

Couleur :
<input type="text" name="couleur" value="<?php echo $data['couleur']; ?>" required><br><br>

Kilométrage :
<input type="number" name="kilometrage" value="<?php echo $data['kilometrage']; ?>" required><br><br>

Client :

<select name="id_client">

<?php
while($c=mysqli_fetch_assoc($clients)){
?>

<option value="<?php echo $c['id']; ?>"
<?php if($c['id']==$data['id_client']) echo "selected"; ?>>

<?php echo $c['nom']." ".$c['prenom']; ?>

</option>

<?php } ?>

</select>

<br><br>

<input type="submit" name="modifier" value="Modifier">

</form>

</body>
</html>