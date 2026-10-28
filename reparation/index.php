<?php

include("../connexion.php");



$reparation_modifier = null;

$recherche = "";



if(isset($_GET['modifier'])){

    $id = $_GET['modifier'];

    $sql = "SELECT * FROM reparation WHERE id = '$id'";

    $result_modifier = mysqli_query($conn, $sql);

    if(!$result_modifier){

        die("Erreur SQL : " . mysqli_error($conn));

    }

    if(mysqli_num_rows($result_modifier) == 1){

        $reparation_modifier =
            mysqli_fetch_assoc($result_modifier);

    }

}



if(isset($_POST['modifier_reparation'])){

    $id = $_POST['id'];

    $id_vehicule = $_POST['id_vehicule'];

    $id_mecanicien = $_POST['id_mecanicien'];

    $description = $_POST['description'];

    $date_entree = $_POST['date_entree'];

    $date_sortie = $_POST['date_sortie'];

    $cout = $_POST['cout'];

    $statut = $_POST['statut'];


    $sql = "UPDATE reparation SET

            id_vehicule = '$id_vehicule',

            id_mecanicien = '$id_mecanicien',

            description = '$description',

            date_entree = '$date_entree',

            date_sortie = '$date_sortie',

            cout = '$cout',

            statut = '$statut'

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

    $id_vehicule = $_POST['id_vehicule'];

    $id_mecanicien = $_POST['id_mecanicien'];

    $description = $_POST['description'];

    $date_entree = $_POST['date_entree'];

    $date_sortie = $_POST['date_sortie'];

    $cout = $_POST['cout'];

    $statut = $_POST['statut'];


    $sql = "INSERT INTO reparation

            (
                id_vehicule,
                id_mecanicien,
                description,
                date_entree,
                date_sortie,
                cout,
                statut
            )

            VALUES

            (
                '$id_vehicule',
                '$id_mecanicien',
                '$description',
                '$date_entree',
                '$date_sortie',
                '$cout',
                '$statut'
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

            reparation.*,

            vehicule.marque,
            vehicule.modele,
            vehicule.immatriculation,

            mecanicien.nom AS nom_mecanicien

        FROM reparation

        INNER JOIN vehicule

        ON reparation.id_vehicule = vehicule.id

        INNER JOIN mecanicien

        ON reparation.id_mecanicien = mecanicien.id

        WHERE reparation.description LIKE '%$recherche%'

        OR reparation.statut LIKE '%$recherche%'

        OR vehicule.marque LIKE '%$recherche%'

        OR vehicule.modele LIKE '%$recherche%'

        OR vehicule.immatriculation LIKE '%$recherche%'

        OR mecanicien.nom LIKE '%$recherche%'

        ORDER BY reparation.id DESC";


$resultat = mysqli_query($conn, $sql);


if(!$resultat){

    die("Erreur SQL : " . mysqli_error($conn));

}



$vehicules = mysqli_query(

    $conn,

    "SELECT *

     FROM vehicule

     ORDER BY marque ASC"

);


if(!$vehicules){

    die(
        "Erreur récupération véhicules : "
        . mysqli_error($conn)
    );

}


$mecaniciens = mysqli_query(

    $conn,

    "SELECT *

     FROM mecanicien

     ORDER BY nom ASC"

);


if(!$mecaniciens){

    die(
        "Erreur récupération mécaniciens : "
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

    <title>Gestion des réparations</title>


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

        🔧 Gestion des réparations

    </h2>


    <div class="row">


        <div class="col-md-4">


            <div class="card shadow">



                <div class="card-header

                    <?php

                    if($reparation_modifier != null){

                        echo "bg-warning";

                    }else{

                        echo "bg-primary text-white";

                    }

                    ?>">


                    <?php

                    if($reparation_modifier != null){

                    ?>

                        <h5 class="mb-0">

                            ✏️ Modifier la réparation

                        </h5>

                    <?php

                    }else{

                    ?>

                        <h5 class="mb-0">

                            ➕ Ajouter une réparation

                        </h5>

                    <?php

                    }

                    ?>


                </div>


                <div class="card-body">


                    
                    <?php

                    if($reparation_modifier != null){

                    ?>


                        <form method="POST">


                            <input
                                type="hidden"
                                name="id"
                                value="<?= $reparation_modifier['id'] ?>">


                            <

                            <div class="mb-3">

                                <label class="form-label">

                                    Véhicule

                                </label>


                                <select
                                    name="id_vehicule"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un véhicule --

                                    </option>


                                    <?php

                                    while(
                                        $vehicule =
                                        mysqli_fetch_assoc($vehicules)
                                    ){

                                    ?>


                                        <option

                                            value="<?= $vehicule['id'] ?>"

                                            <?php

                                            if(
                                                $vehicule['id']
                                                ==
                                                $reparation_modifier[
                                                    'id_vehicule'
                                                ]
                                            ){

                                                echo "selected";

                                            }

                                            ?>
                                        >

                                            <?= htmlspecialchars(

                                                $vehicule['marque']

                                                . " "

                                                . $vehicule['modele']

                                                . " - "

                                                . $vehicule[
                                                    'immatriculation'
                                                ]

                                            ) ?>

                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>


                 

                            <div class="mb-3">

                                <label class="form-label">

                                    Mécanicien

                                </label>


                                <select
                                    name="id_mecanicien"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un mécanicien --

                                    </option>


                                    <?php

                                    while(
                                        $mecanicien =
                                        mysqli_fetch_assoc(
                                            $mecaniciens
                                        )
                                    ){

                                    ?>


                                        <option

                                            value="<?= $mecanicien['id'] ?>"

                                            <?php

                                            if(
                                                $mecanicien['id']
                                                ==
                                                $reparation_modifier[
                                                    'id_mecanicien'
                                                ]
                                            ){

                                                echo "selected";

                                            }

                                            ?>
                                        >

                                            <?= htmlspecialchars(

                                                $mecanicien['nom']

                                                . " - "

                                                . $mecanicien[
                                                    'specialite'
                                                ]

                                            ) ?>

                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>


     

                            <div class="mb-3">

                                <label class="form-label">

                                    Description

                                </label>


                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="3"
                                    required><?= htmlspecialchars(
                                        $reparation_modifier[
                                            'description'
                                        ]
                                    ) ?></textarea>

                            </div>


      

                            <div class="mb-3">

                                <label class="form-label">

                                    Date d'entrée

                                </label>


                                <input
                                    type="date"
                                    name="date_entree"
                                    class="form-control"

                                    value="<?= $reparation_modifier[
                                        'date_entree'
                                    ] ?>"

                                    required>

                            </div>


               

                            <div class="mb-3">

                                <label class="form-label">

                                    Date de sortie

                                </label>


                                <input
                                    type="date"
                                    name="date_sortie"
                                    class="form-control"

                                    value="<?= $reparation_modifier[
                                        'date_sortie'
                                    ] ?>">

                            </div>


                            <div class="mb-3">

                                <label class="form-label">

                                    Coût (Ar)

                                </label>


                                <input
                                    type="number"
                                    name="cout"
                                    class="form-control"

                                    value="<?= $reparation_modifier[
                                        'cout'
                                    ] ?>"

                                    min="0"

                                    required>

                            </div>


            

                            <div class="mb-3">

                                <label class="form-label">

                                    Statut

                                </label>


                                <select
                                    name="statut"
                                    class="form-select"
                                    required>


                                    <option
                                        value="En attente"

                                        <?php

                                        if(
                                            $reparation_modifier[
                                                'statut'
                                            ]
                                            ==
                                            "En attente"
                                        ){

                                            echo "selected";

                                        }

                                        ?>
                                    >

                                        En attente

                                    </option>


                                    <option
                                        value="En cours"

                                        <?php

                                        if(
                                            $reparation_modifier[
                                                'statut'
                                            ]
                                            ==
                                            "En cours"
                                        ){

                                            echo "selected";

                                        }

                                        ?>
                                    >

                                        En cours

                                    </option>


                                    <option
                                        value="Terminée"

                                        <?php

                                        if(
                                            $reparation_modifier[
                                                'statut'
                                            ]
                                            ==
                                            "Terminée"
                                        ){

                                            echo "selected";

                                        }

                                        ?>
                                    >

                                        Terminée

                                    </option>


                                </select>

                            </div>


                            <!-- MODIFIER -->

                            <button
                                type="submit"
                                name="modifier_reparation"
                                class="btn btn-warning w-100">

                                 Enregistrer la modification

                            </button>


                            <!-- ANNULER -->

                            <a
                                href="/garage/reparation/index.php"
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

                                    Véhicule

                                </label>


                                <select
                                    name="id_vehicule"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un véhicule --

                                    </option>


                                    <?php

                                    while(
                                        $vehicule =
                                        mysqli_fetch_assoc($vehicules)
                                    ){

                                    ?>


                                        <option
                                            value="<?= $vehicule['id'] ?>">

                                            <?= htmlspecialchars(

                                                $vehicule['marque']

                                                . " "

                                                . $vehicule['modele']

                                                . " - "

                                                . $vehicule[
                                                    'immatriculation'
                                                ]

                                            ) ?>

                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>


                     

                            <div class="mb-3">

                                <label class="form-label">

                                    Mécanicien

                                </label>


                                <select
                                    name="id_mecanicien"
                                    class="form-select"
                                    required>


                                    <option value="">

                                        -- Choisir un mécanicien --

                                    </option>


                                    <?php

                                    while(
                                        $mecanicien =
                                        mysqli_fetch_assoc(
                                            $mecaniciens
                                        )
                                    ){

                                    ?>


                                        <option
                                            value="<?= $mecanicien['id'] ?>">

                                            <?= htmlspecialchars(

                                                $mecanicien['nom']

                                                . " - "

                                                . $mecanicien[
                                                    'specialite'
                                                ]

                                            ) ?>

                                        </option>


                                    <?php

                                    }

                                    ?>


                                </select>

                            </div>


                          

                            <div class="mb-3">

                                <label class="form-label">

                                    Description

                                </label>


                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Ex : Changement d'huile..."
                                    required></textarea>

                            </div>


                   

                            <div class="mb-3">

                                <label class="form-label">

                                    Date d'entrée

                                </label>


                                <input
                                    type="date"
                                    name="date_entree"
                                    class="form-control"
                                    required>

                            </div>


                     
                            <div class="mb-3">

                                <label class="form-label">

                                    Date de sortie

                                </label>


                                <input
                                    type="date"
                                    name="date_sortie"
                                    class="form-control">

                            </div>


                        

                            <div class="mb-3">

                                <label class="form-label">

                                    Coût (Ar)

                                </label>


                                <input
                                    type="number"
                                    name="cout"
                                    class="form-control"
                                    placeholder="Ex : 150000"
                                    min="0"
                                    required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">

                                    Statut

                                </label>


                                <select
                                    name="statut"
                                    class="form-select"
                                    required>


                                    <option value="En attente">

                                        En attente

                                    </option>


                                    <option value="En cours">

                                        En cours

                                    </option>


                                    <option value="Terminée">

                                        Terminée

                                    </option>


                                </select>

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

                         Liste des réparations

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

                                placeholder="Rechercher une réparation..."

                                value="<?= htmlspecialchars(
                                    $recherche
                                ) ?>">


                            <button
                                type="submit"
                                class="btn btn-primary">

                                 Rechercher

                            </button>


                            <a
                                href="/garage/reparation/index.php"
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

                                    <th>Véhicule</th>

                                    <th>Immatriculation</th>

                                    <th>Mécanicien</th>

                                    <th>Description</th>

                                    <th>Entrée</th>

                                    <th>Sortie</th>

                                    <th>Coût</th>

                                    <th>Statut</th>

                                    <th>Action</th>

                                </tr>


                            </thead>


                            <tbody>


                            <?php

                            if(mysqli_num_rows($resultat) > 0){


                                while(
                                    $reparation =
                                    mysqli_fetch_assoc($resultat)
                                ){

                            ?>


                                <tr>


                                    <td>

                                        <?= $reparation['id'] ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(

                                            $reparation['marque']

                                            . " "

                                            . $reparation['modele']

                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(

                                            $reparation[
                                                'immatriculation'
                                            ]

                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(

                                            $reparation[
                                                'nom_mecanicien'
                                            ]

                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(

                                            $reparation[
                                                'description'
                                            ]

                                        ) ?>

                                    </td>


                                    <td>

                                        <?= $reparation[
                                            'date_entree'
                                        ] ?>

                                    </td>


                                    <td>

                                        <?= $reparation[
                                            'date_sortie'
                                        ] ?>

                                    </td>


                                    <td>

                                        <?= number_format(

                                            $reparation['cout'],

                                            0,

                                            ',',

                                            ' '

                                        ) ?>

                                        Ar

                                    </td>


                                    <td>


                                        <?php

                                        if(
                                            $reparation['statut']
                                            == "Terminée"
                                        ){

                                        ?>

                                            <span
                                                class="badge bg-success">

                                                Terminée

                                            </span>


                                        <?php

                                        }elseif(
                                            $reparation['statut']
                                            == "En cours"
                                        ){

                                        ?>

                                            <span
                                                class="badge bg-warning text-dark">

                                                En cours

                                            </span>


                                        <?php

                                        }else{

                                        ?>

                                            <span
                                                class="badge bg-secondary">

                                                En attente

                                            </span>

                                        <?php

                                        }

                                        ?>


                                    </td>


                                    <td>


                                   

                                        <a
                                            href="/garage/reparation/index.php?modifier=<?= $reparation['id'] ?>"

                                            class="btn
                                                   btn-warning
                                                   btn-sm">

                                            ✏️

                                        </a>



                                        <a
                                            href="/garage/reparation/supprimer.php?id=<?= $reparation['id'] ?>"

                                            class="btn
                                                   btn-danger
                                                   btn-sm"

                                            onclick="return confirm(
                                                'Voulez-vous supprimer cette réparation ?'
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
                                        colspan="10"
                                        class="text-center">

                                        Aucune réparation trouvée.

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