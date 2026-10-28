<?php

include("../connexion.php");


$client_modifier = null;

$recherche = "";


if(isset($_GET['modifier'])){

    $id = $_GET['modifier'];

    $sql = "SELECT * FROM client WHERE id = '$id'";

    $result_modifier = mysqli_query($conn, $sql);

    if(!$result_modifier){

        die("Erreur SQL : " . mysqli_error($conn));

    }

    if(mysqli_num_rows($result_modifier) == 1){

        $client_modifier = mysqli_fetch_assoc($result_modifier);

    }

}


if(isset($_POST['modifier_client'])){

    $id = $_POST['id'];

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];


    $sql = "UPDATE client SET

            nom = '$nom',

            prenom = '$prenom',

            telephone = '$telephone',

            adresse = '$adresse'

            WHERE id = '$id'";


    if(mysqli_query($conn, $sql)){

        header("Location: index.php");

        exit();

    }else{

        die("Erreur modification : " . mysqli_error($conn));

    }

}


if(isset($_POST['ajouter'])){

    $nom = $_POST['nom'];

    $prenom = $_POST['prenom'];

    $telephone = $_POST['telephone'];

    $adresse = $_POST['adresse'];


    $sql = "INSERT INTO client

            (nom, prenom, telephone, adresse)

            VALUES

            ('$nom',
             '$prenom',
             '$telephone',
             '$adresse')";


    if(mysqli_query($conn, $sql)){

        header("Location: index.php");

        exit();

    }else{

        die("Erreur ajout : " . mysqli_error($conn));

    }

}



if(isset($_GET['recherche'])){

    $recherche = $_GET['recherche'];

}



$sql = "SELECT *

        FROM client

        WHERE nom LIKE '%$recherche%'

        OR prenom LIKE '%$recherche%'

        OR telephone LIKE '%$recherche%'

        OR adresse LIKE '%$recherche%'

        ORDER BY id DESC";


$resultat = mysqli_query($conn, $sql);


if(!$resultat){

    die("Erreur SQL : " . mysqli_error($conn));

}

?>



<!DOCTYPE html>

<html lang="fr">


<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">


    <title>Gestion des clients</title>



    <link rel="stylesheet"
          href="../css/bootstrap.min.css">


  

    <link rel="stylesheet"
          href="../css/style.css">

</head>



<body>



<?php include("../layout/navbar.php"); ?>

<?php include("../layout/sidebar.php"); ?>









<div class="content">


    <!-- TITRE -->

    <h2 class="mb-4">

        👤 Gestion des clients

    </h2>



    <div class="row">


        

        <div class="col-md-4">


            <div class="card shadow">


                <!-- HEADER -->

                <div class="card-header
                            <?php
                            if($client_modifier != null){
                                echo 'bg-warning';
                            }else{
                                echo 'bg-primary text-white';
                            }
                            ?>">


                    <?php

                    if($client_modifier != null){

                    ?>

                        <h5 class="mb-0">

                            ✏️ Modifier le client

                        </h5>


                    <?php

                    }else{

                    ?>


                        <h5 class="mb-0">

                            ➕ Ajouter un client

                        </h5>


                    <?php

                    }

                    ?>


                </div>



                <!-- CORPS -->

                <div class="card-body">


                  

                    <?php

                    if($client_modifier != null){

                    ?>


                        <form method="POST">


                
                            <input
                                type="hidden"
                                name="id"
                                value="<?= $client_modifier['id'] ?>">


                            <div class="mb-3">

                                <label class="form-label">

                                    Nom

                                </label>


                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $client_modifier['nom']
                                    ) ?>"

                                    required>

                            </div>



                            

                            <div class="mb-3">

                                <label class="form-label">

                                    Prénom

                                </label>


                                <input
                                    type="text"
                                    name="prenom"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $client_modifier['prenom']
                                    ) ?>"

                                    required>

                            </div>




                            <div class="mb-3">

                                <label class="form-label">

                                    Téléphone

                                </label>


                                <input
                                    type="text"
                                    name="telephone"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $client_modifier['telephone']
                                    ) ?>"

                                    required>

                            </div>




                            <div class="mb-3">

                                <label class="form-label">

                                    Adresse

                                </label>


                                <textarea
                                    name="adresse"
                                    class="form-control"
                                    rows="3"
                                    required><?= htmlspecialchars(
                                        $client_modifier['adresse']
                                    ) ?></textarea>

                            </div>



                            <button
                                type="submit"
                                name="modifier_client"
                                class="btn btn-warning w-100">

                                 Enregistrer la modification

                            </button>



              

                            <a
                                href="/garage/client/index.php"
                                class="btn btn-secondary
                                       w-100 mt-2">

                                Annuler

                            </a>


                        </form>



                    <?php

                    }else{

                    ?>


                   

                        <form method="POST">


                        

                            <div class="mb-3">

                                <label class="form-label">

                                    Nom

                                </label>


                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"
                                    placeholder="Nom du client"
                                    required>

                            </div>


                      

                            <div class="mb-3">

                                <label class="form-label">

                                    Prénom

                                </label>


                                <input
                                    type="text"
                                    name="prenom"
                                    class="form-control"
                                    placeholder="Prénom du client"
                                    required>

                            </div>



                      

                            <div class="mb-3">

                                <label class="form-label">

                                    Téléphone

                                </label>


                                <input
                                    type="text"
                                    name="telephone"
                                    class="form-control"
                                    placeholder="034 XX XXX XX"
                                    required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    Adresse

                                </label>


                                <textarea
                                    name="adresse"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Adresse du client"
                                    required></textarea>

                            </div>


             

                            <button
                                type="submit"
                                name="ajouter"
                                class="btn btn-primary w-100">

                                 Enregistrer

                            </button>


                        </form>


                    <?php

                    }

                    ?>


                </div>


            </div>


        </div>



     
        <div class="col-md-8">


            <div class="card shadow">


              

                <div class="card-header bg-dark text-white">


                    <h5 class="mb-0">

                         Liste des clients
                    </h5>


                </div>



                <div class="card-body">

                    <form
                        method="GET"
                        class="mb-3">


                        <div class="input-group">


                            <input
                                type="text"
                                name="recherche"
                                class="form-control"

                                placeholder="Rechercher un client..."

                                value="<?= htmlspecialchars(
                                    $recherche
                                ) ?>">



                            <button
                                type="submit"
                                class="btn btn-primary">

                                 Rechercher
                            </button>



                            <a
                                href="/garage/client/index.php"
                                class="btn btn-secondary">

                                Réinitialiser

                            </a>


                        </div>


                    </form>



      

                    <div class="table-responsive">


                        <table
                            class="table
                                   table-bordered
                                   table-striped
                                   align-middle">


                            <thead class="table-dark">


                                <tr>


                                    <th>

                                        ID

                                    </th>


                                    <th>

                                        Nom

                                    </th>


                                    <th>

                                        Prénom

                                    </th>


                                    <th>

                                        Téléphone

                                    </th>


                                    <th>

                                        Adresse

                                    </th>


                                    <th>

                                        Action

                                    </th>


                                </tr>


                            </thead>



                            <tbody>


                            <?php


                            if(mysqli_num_rows($resultat) > 0){


                                while(
                                    $client =
                                    mysqli_fetch_assoc($resultat)
                                ){


                            ?>


                                <tr>


                             
                                    <td>

                                        <?= $client['id'] ?>

                                    </td>



                                  

                                    <td>

                                        <?= htmlspecialchars(
                                            $client['nom']
                                        ) ?>

                                    </td>



                                    <td>

                                        <?= htmlspecialchars(
                                            $client['prenom']
                                        ) ?>

                                    </td>



                            

                                    <td>

                                        <?= htmlspecialchars(
                                            $client['telephone']
                                        ) ?>

                                    </td>



                                    <td>

                                        <?= htmlspecialchars(
                                            $client['adresse']
                                        ) ?>

                                    </td>



                           

                                    <td>


                      

                                        <a
                                            href="/garage/client/index.php?modifier=<?= $client['id'] ?>"

                                            class="btn
                                                   btn-warning
                                                   btn-sm">

                                            ✏️

                                        </a>



                         

                                        <a
                                            href="/garage/client/supprimer.php?id=<?= $client['id'] ?>"

                                            class="btn
                                                   btn-danger
                                                   btn-sm"

                                            onclick="return confirm(
                                                'Voulez-vous supprimer ce client ?'
                                            )">

                                            🗑️

                                        </a>


                                    </td>


                                </tr>


                            <?php


                                }


                            }else{


                            ?>


                                <tr>


                                    <td
                                        colspan="6"
                                        class="text-center">


                                        Aucun client trouvé.


                                    </td>


                                </tr>


                            <?php


                            }


                            ?>


                            </tbody>


                        </table>


                    </div>


                </div>


            </div>


        </div>


    </div>


</div>


</body>

</html>