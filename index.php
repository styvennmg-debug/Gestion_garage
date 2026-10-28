<?php
session_start();
include("connexion.php");
include("layout/header.php");
include("layout/navbar.php");
include("layout/sidebar.php");
?>

<div class="content">


<?php

$nbClient = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM client"));

$nbVehicule = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM vehicule"));

$nbMecanicien = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM mecanicien"));

$nbReparation = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reparation"));

?>

<div class="container-fluid">

<h2 class="mb-4">Tableau de bord</h2>

<div class="row">

<div class="col-md-3">

<div class="card bg-primary text-white">

<div class="card-body">

<h5>👤 Clients</h5>

<h2><?php echo $nbClient; ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-success text-white">

<div class="card-body">

<h5>🚗 Véhicules</h5>

<h2><?php echo $nbVehicule; ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-warning text-white">

<div class="card-body">

<h5>👨‍🔧 Mécaniciens</h5>

<h2><?php echo $nbMecanicien; ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-danger text-white">

<div class="card-body">

<h5>🔧 Réparations</h5>

<h2><?php echo $nbReparation; ?></h2>

</div>

</div>

</div>

</div>

</div>

<h2>Bienvenue dans votre Garage Automobile</h2>
</div>
