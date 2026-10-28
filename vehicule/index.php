<?php

include("../connexion.php");



$vehicule_modifier = null;

$recherche = "";



if(isset($_GET['modifier'])){

    $id = $_GET['modifier'];

    $sql = "SELECT * FROM vehicule WHERE id = '$id'";

    $result_modifier = mysqli_query($conn, $sql);

    if(!$result_modifier){

        die("Erreur SQL : " . mysqli_error($conn));

    }

    if(mysqli_num_rows($result_modifier) == 1){

        $vehicule_modifier =
            mysqli_fetch_assoc($result_modifier);

    }

}



if(isset($_POST['modifier_vehicule'])){

    $id = $_POST['id'];

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];
    $kilometrage = $_POST['kilometrage'];
    $id_client = $_POST['id_client'];


    $sql = "UPDATE vehicule SET

            marque = '$marque',

            modele = '$modele',

            immatriculation = '$immatriculation',

            annee = '$annee',

            couleur = '$couleur',

            kilometrage = '$kilometrage',

            id_client = '$id_client'

            WHERE id = '$id'";


    if(mysqli_query($conn, $sql)){

        header("Location: index.php");

        exit();

    }else{

        die(
            "Erreur modification : "
            . mysqli_error($conn)
        );

    }

}



if(isset($_POST['ajouter'])){

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];
    $kilometrage = $_POST['kilometrage'];
    $id_client = $_POST['id_client'];


    $sql = "INSERT INTO vehicule

            (
                marque,
                modele,
                immatriculation,
                annee,
                couleur,
                kilometrage,
                id_client
            )

            VALUES

            (
                '$marque',
                '$modele',
                '$immatriculation',
                '$annee',
                '$couleur',
                '$kilometrage',
                '$id_client'
            )";


    if(mysqli_query($conn, $sql)){

        header("Location: index.php");

        exit();

    }else{

        die(
            "Erreur ajout : "
            . mysqli_error($conn)
        );

    }

}


if(isset($_GET['recherche'])){

    $recherche = $_GET['recherche'];

}




$sql = "SELECT

            vehicule.*,

            client.nom AS nom_client,

            client.prenom AS prenom_client

        FROM vehicule

        INNER JOIN client

        ON vehicule.id_client = client.id

        WHERE vehicule.marque LIKE '%$recherche%'

        OR vehicule.modele LIKE '%$recherche%'

        OR vehicule.immatriculation LIKE '%$recherche%'

        OR vehicule.couleur LIKE '%$recherche%'

        OR client.nom LIKE '%$recherche%'

        OR client.prenom LIKE '%$recherche%'

        ORDER BY vehicule.id DESC";


$resultat = mysqli_query($conn, $sql);


if(!$resultat){

    die("Erreur SQL : " . mysqli_error($conn));

}



$clients = mysqli_query(
    $conn,
    "SELECT * FROM client ORDER BY nom ASC"
);


if(!$clients){

    die(
        "Erreur récupération clients : "
        . mysqli_error($conn)
    );

}

?>



<!DOCTYPE html>

<html lang="fr">


<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">


    <title>Gestion des véhicules</title>


    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css">


  

    <link
        rel="stylesheet"
        href="../css/style.css">

</head>



<body>


<?php include("../layout/navbar.php"); ?>
<?php include("../layout/sidebar.php"); ?>





<div class="content">


    <h2 class="mb-4">

        🚗 Gestion des véhicules

    </h2>



    <div class="row">


      
        <div class="col-md-4">


            <div class="card shadow">


              

                <div class="card-header
                    <?php

                    if($vehicule_modifier != null){

                        echo "bg-warning";

                    }else{

                        echo "bg-primary text-white";

                    }

                    ?>">


                    <?php

                    if($vehicule_modifier != null){

                    ?>

                        <h5 class="mb-0">

                            ✏️ Modifier le véhicule

                        </h5>


                    <?php

                    }else{

                    ?>

                        <h5 class="mb-0">

                            ➕ Ajouter un véhicule

                        </h5>


                    <?php

                    }

                    ?>


                </div>



      

                <div class="card-body">


               
                    <?php

                    if($vehicule_modifier != null){

                    ?>


                        <form method="POST">


                            <!-- ID -->

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $vehicule_modifier['id'] ?>">



                            <!-- MARQUE -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Marque

                                </label>


                                <input
                                    type="text"
                                    name="marque"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $vehicule_modifier['marque']
                                    ) ?>"

                                    required>

                            </div>


  

                            <div class="mb-3">

                                <label class="form-label">

                                    Modèle

                                </label>


                                <input
                                    type="text"
                                    name="modele"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $vehicule_modifier['modele']
                                    ) ?>"

                                    required>

                            </div>



                        

                            <div class="mb-3">

                                <label class="form-label">

                                    Immatriculation

                                </label>


                                <input
                                    type="text"
                                    name="immatriculation"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $vehicule_modifier[
                                            'immatriculation'
                                        ]
                                    ) ?>"

                                    required>

                            </div>



             

                            <div class="mb-3">

                                <label class="form-label">

                                    Année

                                </label>


                                <input
                                    type="number"
                                    name="annee"
                                    class="form-control"

                                    value="<?= $vehicule_modifier[
                                        'annee'
                                    ] ?>"

                                    required>

                            </div>




                            <div class="mb-3">

                                <label class="form-label">

                                    Couleur

                                </label>


                                <input
                                    type="text"
                                    name="couleur"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $vehicule_modifier['couleur']
                                    ) ?>"

                                    required>

                            </div>



                         

                            <div class="mb-3">

                                <label class="form-label">

                                    Kilométrage

                                </label>


                                <input
                                    type="number"
                                    name="kilometrage"
                                    class="form-control"

                                    value="<?= $vehicule_modifier[
                                        'kilometrage'
                                    ] ?>"

                                    min="0"

                                    required>

                            </div>



                            <!-- CLIENT -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Propriétaire

                                </label>


                                <select
                                    name="id_client"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un client --

                                    </option>


                                    <?php

                                    while(
                                        $client =
                                        mysqli_fetch_assoc($clients)
                                    ){

                                    ?>


                                        <option
                                            value="<?= $client['id'] ?>"

                                            <?php

                                            if(
                                                $client['id']
                                                ==
                                                $vehicule_modifier[
                                                    'id_client'
                                                ]
                                            ){

                                                echo "selected";

                                            }

                                            ?>
                                        >


                                            <?= htmlspecialchars(
                                                $client['nom']
                                                . " "
                                                . $client['prenom']
                                            ) ?>


                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>



                         

                            <button
                                type="submit"
                                name="modifier_vehicule"
                                class="btn btn-warning w-100">

                                 Enregistrer la modification

                            </button>



                            <a
                                href="/garage/vehicule/index.php"
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

                                    Marque

                                </label>


                                <input
                                    type="text"
                                    name="marque"
                                    class="form-control"
                                    placeholder="Ex : Toyota"
                                    required>

                            </div>



                     
                            <div class="mb-3">

                                <label class="form-label">

                                    Modèle

                                </label>


                                <input
                                    type="text"
                                    name="modele"
                                    class="form-control"
                                    placeholder="Ex : Corolla"
                                    required>

                            </div>



               

                            <div class="mb-3">

                                <label class="form-label">

                                    Immatriculation

                                </label>


                                <input
                                    type="text"
                                    name="immatriculation"
                                    class="form-control"
                                    placeholder="Ex : 1234 TAA"
                                    required>

                            </div>



                           

                            <div class="mb-3">

                                <label class="form-label">

                                    Année

                                </label>


                                <input
                                    type="number"
                                    name="annee"
                                    class="form-control"
                                    placeholder="Ex : 2020"
                                    required>

                            </div>



                    

                            <div class="mb-3">

                                <label class="form-label">

                                    Couleur

                                </label>


                                <input
                                    type="text"
                                    name="couleur"
                                    class="form-control"
                                    placeholder="Ex : Noir"
                                    required>

                            </div>



                

                            <div class="mb-3">

                                <label class="form-label">

                                    Kilométrage

                                </label>


                                <input
                                    type="number"
                                    name="kilometrage"
                                    class="form-control"
                                    placeholder="Ex : 50000"
                                    min="0"
                                    required>

                            </div>



                        

                            <div class="mb-3">

                                <label class="form-label">

                                    Propriétaire

                                </label>


                                <select
                                    name="id_client"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un client --

                                    </option>


                                    <?php

                                    while(
                                        $client =
                                        mysqli_fetch_assoc($clients)
                                    ){

                                    ?>


                                        <option
                                            value="<?= $client['id'] ?>">


                                            <?= htmlspecialchars(
                                                $client['nom']
                                                . " "
                                                . $client['prenom']
                                            ) ?>


                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>



                            <!-- AJOUT -->

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

                         Liste des véhicules

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

                                placeholder="Rechercher un véhicule..."

                                value="<?= htmlspecialchars(
                                    $recherche
                                ) ?>">


                            <button
                                type="submit"
                                class="btn btn-primary">
                                     Rechercher

                            </button>


                            <a
                                href="/garage/vehicule/index.php"
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

                                    <th>ID</th>

                                    <th>Marque</th>

                                    <th>Modèle</th>

                                    <th>Immatriculation</th>

                                    <th>Année</th>

                                    <th>Couleur</th>

                                    <th>Kilométrage</th>

                                    <th>Propriétaire</th>

                                    <th>Action</th>

                                </tr>


                            </thead>



                            <tbody>


                            <?php


                            if(mysqli_num_rows($resultat) > 0){


                                while(
                                    $vehicule =
                                    mysqli_fetch_assoc($resultat)
                                ){


                            ?>


                                <tr>


                                    <td>

                                        <?= $vehicule['id'] ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $vehicule['marque']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $vehicule['modele']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $vehicule[
                                                'immatriculation'
                                            ]
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= $vehicule['annee'] ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $vehicule['couleur']
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= $vehicule[
                                            'kilometrage'
                                        ] ?>

                                        km

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $vehicule['nom_client']
                                            . " "
                                            . $vehicule['prenom_client']
                                        ) ?>

                                    </td>


                                    <td>


                                        <!-- MODIFIER -->

                                        <a
                                            href="/garage/vehicule/index.php?modifier=<?= $vehicule['id'] ?>"

                                            class="btn
                                                   btn-warning
                                                   btn-sm">

                                            ✏️

                                        </a>



                                        <!-- SUPPRIMER -->

                                        <a
                                            href="/garage/vehicule/supprimer.php?id=<?= $vehicule['id'] ?>"

                                            class="btn
                                                   btn-danger
                                                   btn-sm"

                                            onclick="return confirm(
                                                'Voulez-vous supprimer ce véhicule ?'
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
                                        colspan="9"
                                        class="text-center">

                                        Aucun véhicule trouvé.

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