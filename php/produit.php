<?php
session_start();
include('include/connect_inc.php');

    $id = htmlspecialchars($_GET['identifiantP']);

    //prix + description
    $query = "SELECT NOMPRODUIT, PRIXPRODUIT, DESCPRODUIT FROM produit WHERE idproduit = ".$id;
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res[] = ['nom' => $row2['NOMPRODUIT'], 'id'=> $row2['IDPRODUIT'], 'prix' => $row2['PRIXPRODUIT']];
    }

    //produits similaires
    $query = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT FROM produit WHERE idcat = ".$produit['IDCAT'];
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res2[] = ['nom' => $row2['NOMPRODUIT'], 'id'=> $row2['IDPRODUIT'], 'prix' => $row2['PRIXPRODUIT']];
    }
?>

<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
    </head>

    <body>
        <div class="content">
            <?php $page = strtolower(basename(__FILE__, '.php')); include("include/header.php"); ?>
            <main>
                <div class="main-card">
                    <?php
                    echo "<h2>".$res[0]['nom']."</h2>"; //nom produit
                    ?>
                    <div class="main-card-produit">
                        <div class="gallerie">
                            <a class="doigt">👈</a>
                            <img src="./img/pécé.jpg" alt="le Produit" class="img_produit">
                            <a class="doigt">👉</a></div>
                        </div>
                        <h3 class="description_produit">Description :</h3>
                        <?php
                            echo "<p><div><a><strong>".$produit['DESCPRODUIT']."</strong></a></div></p>";
                        ?>
                        <h2>                       
                            <?php
                                echo "<p><div><a><strong>".$produit['PRIXPRODUIT']."</strong></a></div></p>";
                            ?>
                        </h2>
                        <div class="bouton_acheter"><button>Acheter</button></div>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Produits similaires :</h2>
                    <div class="main-card-content">
                        <?php
                            foreach($res2 as $produit) { 
                                echo" <div class=\"produit\">
                                <div><a><strong>".$produit['nom']."</strong></a></div>
                                <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                <div><a class=\"reduc\">".$produit['prix']." €</a></div>
                                <div><a>".$produit['reduc']." €</a></div>
                                <div><a href=\"produit.php?id=".$produit['id']."\"><button>Acheter</button></a></div>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>