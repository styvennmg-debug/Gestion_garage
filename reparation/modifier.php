<?php
include("../connexion.php");

$id = $_GET['id'];

// Récupérer la réparation
$reparation = mysqli_query($conn, "SELECT * FROM reparation WHERE id=$id");
$data = mysqli_fetch_assoc($reparation);

// Récupérer les véhicules
$vehicules = mysqli_query($conn, "SELECT * FROM vehicule");

// Récupérer les mécaniciens
$mecaniciens = mysqli_query($conn, "SELECT * FROM mecanicien");

// Modifier
if(isset($_POST['modifier'])){

    $description = $_POST['description'];
    $date_entree = $_POST['date_entree'];
    $date_sortie = $_POST['date_sortie'];
    $cout = $_POST['cout'];
    $statut = $_POST['statut'];
    $id_vehicule = $_POST['id_vehicule'];
    $id_mecanicien = $_POST['id_mecanicien'];

    $sql = "UPDATE reparation SET
            description='$description',
            date_entree='$date_entree',
            date_sortie='$date_sortie',
            cout='$cout',
            statut='$statut',
            id_vehicule='$id_vehicule',
            id_mecanicien='$id_mecanicien'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une réparation</title>
</head>
<body>

<h2>Modifier une réparation</h2>

<form method="POST">

Description :<br>
<textarea name="description" required><?php echo $data['description']; ?></textarea>

<br><br>

Date d'entrée :<br>
<input type="date" name="date_entree" value="<?php echo $data['date_entree']; ?>" required>

<br><br>

Date de sortie :<br>
<input type="date" name="date_sortie" value="<?php echo $data['date_sortie']; ?>">

<br><br>

Coût :<br>
<input type="number" step="0.01" name="cout" value="<?php echo $data['cout']; ?>" required>

<br><br>

Statut :<br>

<select name="statut">

<option value="En attente" <?php if($data['statut']=="En attente") echo "selected"; ?>>En attente</option>

<option value="En cours" <?php if($data['statut']=="En cours") echo "selected"; ?>>En cours</option>

<option value="Terminée" <?php if($data['statut']=="Terminée") echo "selected"; ?>>Terminée</option>

</select>

<br><br>

Véhicule :<br>

<select name="id_vehicule">

<?php while($v=mysqli_fetch_assoc($vehicules)){ ?>

<option value="<?php echo $v['id']; ?>"
<?php if($v['id']==$data['id_vehicule']) echo "selected"; ?>>

<?php echo $v['marque']." ".$v['modele']." - ".$v['immatriculation']; ?>

</option>

<?php } ?>

</select>

<br><br>

Mécanicien :<br>

<select name="id_mecanicien">

<?php while($m=mysqli_fetch_assoc($mecaniciens)){ ?>

<option value="<?php echo $m['id']; ?>"
<?php if($m['id']==$data['id_mecanicien']) echo "selected"; ?>>

<?php echo $m['nom']; ?>

</option>

<?php } ?>

</select>

<br><br>

<input type="submit" name="modifier" value="Modifier">

</form>

<br>

<a href="index.php">Retour à la liste</a>

</body>
</html>