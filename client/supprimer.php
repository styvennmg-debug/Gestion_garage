<?php

include("../connexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM client WHERE id=$id";

mysqli_query($conn, $sql);

header("Location: index.php");

?>