<?php

include("../connexion.php");




$mecanicien_modifier = null;

$recherche = "";



if(isset($_GET['modifier'])){

    $id = $_GET['modifier'];

    $sql = "SELECT * FROM mecanicien WHERE id = '$id'";

    $result_modifier = mysqli_query($conn, $sql);

    if(!$result_modifier){

        die("Erreur SQL : " . mysqli_error($conn));

    }

    if(mysqli_num_rows($result_modifier) == 1){

        $mecanicien_modifier =
            mysqli_fetch_assoc($result_modifier);

    }

}



if(isset($_POST['modifier_mecanicien'])){

    $id = $_POST['id'];

    $nom = $_POST['nom'];

    $specialite = $_POST['specialite'];

    $telephone = $_POST['telephone'];


    $sql = "UPDATE mecanicien SET

            nom = '$nom',

            specialite = '$specialite',

            telephone = '$telephone'

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

    $nom = $_POST['nom'];

    $specialite = $_POST['specialite'];

    $telephone = $_POST['telephone'];


    $sql = "INSERT INTO mecanicien

            (
                nom,
                specialite,
                telephone
            )

            VALUES

            (
                '$nom',
                '$specialite',
                '$telephone'
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




$sql = "SELECT *

        FROM mecanicien

        WHERE nom LIKE '%$recherche%'

        OR specialite LIKE '%$recherche%'

        OR telephone LIKE '%$recherche%'

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


    <title>Gestion des mécaniciens</title>




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

        👨‍🔧 Gestion des mécaniciens

    </h2>



    <div class="row">


       

        <div class="col-md-4">


            <div class="card shadow">


               

                <div class="card-header
                    <?php

                    if($mecanicien_modifier != null){

                        echo "bg-warning";

                    }else{

                        echo "bg-primary text-white";

                    }

                    ?>">


                    <?php

                    if($mecanicien_modifier != null){

                    ?>

                        <h5 class="mb-0">

                            ✏️ Modifier le mécanicien

                        </h5>


                    <?php

                    }else{

                    ?>

                        <h5 class="mb-0">

                            ➕ Ajouter un mécanicien

                        </h5>


                    <?php

                    }

                    ?>


                </div>



                <div class="card-body">


                  
                    <?php

                    if($mecanicien_modifier != null){

                    ?>


                        <form method="POST">


                            <!-- ID -->

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $mecanicien_modifier['id'] ?>">



                            <!-- NOM -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Nom

                                </label>


                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $mecanicien_modifier['nom']
                                    ) ?>"

                                    required>

                            </div>



                           

                            <div class="mb-3">

                                <label class="form-label">

                                    Spécialité

                                </label>


                                <input
                                    type="text"
                                    name="specialite"
                                    class="form-control"

                                    value="<?= htmlspecialchars(
                                        $mecanicien_modifier[
                                            'specialite'
                                        ]
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
                                        $mecanicien_modifier[
                                            'telephone'
                                        ]
                                    ) ?>"

                                    required>

                            </div>




                            <button
                                type="submit"
                                name="modifier_mecanicien"
                                class="btn btn-warning w-100">

                                 Enregistrer la modification

                            </button>



                            <!-- ANNULER -->

                            <a
                                href="/garage/mecanicien/index.php"
                                class="btn btn-secondary
                                       w-100 mt-2">

                                Annuler

                            </a>


                        </form>



                    <?php

                    }else{

                    ?>


                    

                        <form method="POST">


                            <!-- NOM -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Nom

                                </label>


                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"
                                    placeholder="Nom du mécanicien"
                                    required>

                            </div>



                       

                            <div class="mb-3">

                                <label class="form-label">

                                    Spécialité

                                </label>


                                <input
                                    type="text"
                                    name="specialite"
                                    class="form-control"
                                    placeholder="Ex : Moteur, Freinage..."
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

                         Liste des mécaniciens

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

                                placeholder="Rechercher un mécanicien..."

                                value="<?= htmlspecialchars(
                                    $recherche
                                ) ?>">


                            <button
                                type="submit"
                                class="btn btn-primary">

                                 Rechercher

                            </button>


                            <a
                                href="/garage/mecanicien/index.php"
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

                                    <th>Nom</th>

                                    <th>Spécialité</th>

                                    <th>Téléphone</th>

                                    <th>Action</th>

                                </tr>


                            </thead>



                            <tbody>


                            <?php


                            if(mysqli_num_rows($resultat) > 0){


                                while(
                                    $mecanicien =
                                    mysqli_fetch_assoc($resultat)
                                ){


                            ?>


                                <tr>



                                    <td>

                                        <?= $mecanicien['id'] ?>

                                    </td>



                               

                                    <td>

                                        <?= htmlspecialchars(
                                            $mecanicien['nom']
                                        ) ?>

                                    </td>



                              

                                    <td>

                                        <?= htmlspecialchars(
                                            $mecanicien[
                                                'specialite'
                                            ]
                                        ) ?>

                                    </td>


>

                                    <td>

                                        <?= htmlspecialchars(
                                            $mecanicien[
                                                'telephone'
                                            ]
                                        ) ?>

                                    </td>



                                 

                                    <td>


                    
                                        <a
                                            href="/garage/mecanicien/index.php?modifier=<?= $mecanicien['id'] ?>"

                                            class="btn
                                                   btn-warning
                                                   btn-sm">

                                            ✏️

                                        </a>



                                   
                                        <a
                                            href="/garage/mecanicien/supprimer.php?id=<?= $mecanicien['id'] ?>"

                                            class="btn
                                                   btn-danger
                                                   btn-sm"

                                            onclick="return confirm(
                                                'Voulez-vous supprimer ce mécanicien ?'
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
                                        colspan="5"
                                        class="text-center">

                                        Aucun mécanicien trouvé.

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