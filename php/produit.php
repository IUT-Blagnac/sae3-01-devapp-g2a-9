<?php
session_start();
    $db = "(DESCRIPTION =
                (ADDRESS = (PROTOCOL = TCP)(HOST = oracle.iut-blagnac.fr)(PORT = 1521))
                (CONNECT_DATA =
                  (SERVER = DEDICATED)
                  (SID = db11g)
                )
              )";
    $conn = oci_connect("SAEBD09", "M0ntBlanc1UT", $db);

    //prix + description
    $query = "SELECT PRIXPRODUIT, DESCPRODUIT FROM produit WHERE idproduit = ".$_GET['identifiantP'];
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res[] = $row['PRIX'];
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
                    <h2>*Nom produit*</h2>
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