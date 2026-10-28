<?php

include("../connexion.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM mecanicien WHERE id=$id");

header("Location:index.php");

?>