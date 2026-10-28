<?php

session_start();

include("../connexion.php");

$erreur = "";
$succes = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];


    $sql = "SELECT * FROM utilisateur
            WHERE email = '$email'";


    $resultat = mysqli_query($conn, $sql);


    if(!$resultat){

        die("Erreur SQL : " . mysqli_error($conn));

    }


    if(mysqli_num_rows($resultat) == 1){

        $user = mysqli_fetch_assoc($resultat);


        // Pour l'instant, comparaison simple
        if($mot_de_passe == $user['mot_de_passe']){

            $_SESSION['id'] = $user['id'];

            $_SESSION['nom'] = $user['nom'];

            $_SESSION['email'] = $user['email'];


            header("Location: ../index.php");

            exit();

        }else{

            $erreur =
                "Mot de passe incorrect.";

        }

    }else{

        $erreur =
            "Adresse email introuvable.";

    }

}


if(isset($_POST['inscription'])){

    $nom = trim($_POST['nom']);

    $email = trim($_POST['email']);

    $mot_de_passe = $_POST['mot_de_passe'];

    $confirmation = $_POST['confirmation'];


    if($mot_de_passe != $confirmation){

        $erreur =
            "Les deux mots de passe ne correspondent pas.";

    }else{

        $verification = mysqli_query(

            $conn,

            "SELECT * FROM utilisateur
             WHERE email = '$email'"

        );

        if(!$verification){

            die(
                "Erreur SQL : "
                . mysqli_error($conn)
            );

        }


        if(mysqli_num_rows($verification) > 0){

            $erreur =
                "Cette adresse email est déjà utilisée.";

        }else{


            $sql = "INSERT INTO utilisateur
                    (nom, email, mot_de_passe)

                    VALUES

                    (
                        '$nom',
                        '$email',
                        '$mot_de_passe'
                    )";


            if(mysqli_query($conn, $sql)){

                $succes =
                    "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";

            }else{

                $erreur =
                    "Erreur lors de l'inscription : "
                    . mysqli_error($conn);

            }

        }

    }

}

?>

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Connexion - Garage Automobile
    </title>


    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css">


    <link
        rel="stylesheet"
        href="../css/login.css">

</head>


<body>


<div class="login-page">


    <div class="login-card">


        <!-- LOGO -->

        <div class="logo">

            🚗

        </div>


        <h2>

            Garage Automobile

        </h2>


        <p class="subtitle">

            Gestion de votre garage by Tsiky

        </p>

        <?php if($erreur != ""){ ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($erreur) ?>

            </div>

        <?php } ?>


        <?php if($succes != ""){ ?>

            <div class="alert alert-success">

                <?= htmlspecialchars($succes) ?>

            </div>

        <?php } ?>

        <div id="connexion">


            <form method="POST">


                <div class="form-group">

                    <label>

                        Adresse email

                    </label>


                    <div class="input-box">

                        <span>📧</span>


                        <input
                            type="email"
                            name="email"
                            placeholder="Entrez votre email"
                            required>

                    </div>

                </div>

                <div class="form-group">

                    <label>

                        Mot de passe

                    </label>


                    <div class="input-box">

                        <span>🔒</span>


                        <input
                            type="password"
                            name="mot_de_passe"
                            placeholder="Entrez votre mot de passe"
                            required>

                    </div>

                </div>


                <button
                    type="submit"
                    name="login"
                    class="login-button">

                     Se connecter

                </button>


            </form>


            <div class="register-link">

                Vous n'avez pas encore de compte ?

                <button
                    type="button"
                    onclick="afficherInscription()">

                    Créer un compte

                </button>

            </div>


        </div>


  <div
            id="inscription"
            style="display:none;">


            <form method="POST">


                <!-- NOM -->

                <div class="form-group">

                    <label>

                        Nom complet

                    </label>


                    <div class="input-box">

                        <span>👤</span>


                        <input
                            type="text"
                            name="nom"
                            placeholder="Votre nom"
                            required>

                    </div>

                </div>


              

                <div class="form-group">

                    <label>

                        Adresse email

                    </label>


                    <div class="input-box">

                        <span>📧</span>


                        <input
                            type="email"
                            name="email"
                            placeholder="Votre adresse email"
                            required>

                    </div>

                </div>


            

                <div class="form-group">

                    <label>

                        Mot de passe

                    </label>


                    <div class="input-box">

                        <span>🔒</span>


                        <input
                            type="password"
                            name="mot_de_passe"
                            placeholder="Choisissez un mot de passe"
                            required>

                    </div>

                </div>



                <div class="form-group">

                    <label>

                        Confirmer le mot de passe

                    </label>


                    <div class="input-box">

                        <span>🔐</span>


                        <input
                            type="password"
                            name="confirmation"
                            placeholder="Confirmez le mot de passe"
                            required>

                    </div>

                </div>


           

                <button
                    type="submit"
                    name="inscription"
                    class="login-button">

                     Créer mon compte

                </button>


            </form>


            <div class="register-link">

                Vous avez déjà un compte ?

                <button
                    type="button"
                    onclick="afficherConnexion()">

                    Se connecter

                </button>

            </div>


        </div>



        <div class="login-footer">

            Garage Automobile © 2026

        </div>


    </div>

</div>



<script>

function afficherInscription(){

    document.getElementById("connexion").style.display =
        "none";

    document.getElementById("inscription").style.display =
        "block";

}


function afficherConnexion(){

    document.getElementById("inscription").style.display =
        "none";

    document.getElementById("connexion").style.display =
        "block";

}

</script>


</body>

</html>