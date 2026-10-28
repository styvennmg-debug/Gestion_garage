<?php

session_start();

include("../connexion.php");

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$sql = "SELECT * FROM utilisateur
WHERE email='$email'
AND mot_de_passe='$mot_de_passe'";

$resultat = mysqli_query($conn,$sql);

if(mysqli_num_rows($resultat)>0){

    $_SESSION['email']=$email;

    header("Location:../index.php");

}else{

    echo "Email ou mot de passe incorrect.";

}

?>