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

    //categories
    $query = "SELECT nomcat FROM categorie";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res[] = $row['NOMCAT'];
    }
    
    //nouveautées
    $query = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT FROM produit WHERE dateproduit BETWEEN ADD_MONTHS(sysdate, -6) and sysdate;";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res2 = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT']];
    }

    oci_free_statement($stid);
    oci_close($conn);
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
                    <h2>Catégories</h2>
                    <div class="main-card-content">
                        <?php
                            foreach ($res as $categorie){
                            echo " <a href=\"Categories.php?cat=" . $categorie . "\" class=\"categorie\"><button>".ucwords($categorie)."</button></a>";
                            }
                        ?>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Nouveautés</h2>
                    <!-- SELECT FROM Produit WHERE date jsp-->
                    <div class="main-card-content">
                        <?php
                            echo "$res2";
                            foreach($res2 as $produit) { 
                                echo" <div class=\"produit\">
                                <div><a>".$produit['nom']."</a></div>
                                <div><img src=\"./img/produits".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                <div><a>".$produit['prix']."</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Soldes</h2>
                    <!-- SELECT FROM Produit WHERE reduc > 0 -->
                    <div class="main-card-content">
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>