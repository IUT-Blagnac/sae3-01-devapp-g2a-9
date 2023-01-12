<?php 
error_reporting(E_ERROR | E_PARSE);
include("include/connect_inc.php");

//categories
$query = "SELECT NOMCAT FROM CATEGORIE";
$stid = oci_parse($connect, $query);
oci_execute($stid);

while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
    $categories[] = $row['NOMCAT'];
}


// Produits par catégorie
if (isset($_REQUEST["cat"])) {
    $query = "SELECT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC FROM produit P, categorie C, SOUSCATEGORIE S WHERE C.IDCAT = :categorie";
    $categorie = $_REQUEST["cat"];
    $stid = oci_parse($connect, $query);

    oci_bind_by_name($stid, ":categorie", $categorie);

    $res = oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $produits[] = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'reduc' => $row['REDUC']];
    }
    oci_free_statement($stid);
    oci_close($conn);
}

?>

<html lang="fr">
    <head>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
        <div class="content">
            <?php $page = strtolower(basename(__FILE__, '.php')); include("include/header.php"); ?>
            <main>
                <!-- select $nomCat FROM Categorie WHERE idCat = $_GET['cat']-->
                <div class="main-card">
                    <h2>Catégories</h2>
                    <div class="main-card-content">
                        <?php
                            foreach ($categories as $i){
                                echo " <a href=\"Categories.php?cat=" . $i . "\" class=\"categorie\"><button>".ucwords($i)."</button></a>";
                            }
                        ?>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST["cat"])) {
                    echo "<div class=\"main-card\">
                        <h2>" . ucwords($_REQUEST["cat"]) . "</h2>
                        <div class=\"main-card-content\">";
                        foreach ($produits as $produit) {
                            echo "<div class=\"produit\">
                            <div><a><strong>".$produit['nom']."</strong></a></div>
                            <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                            <div><a>".$produit['prix']." €</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>";
                        }
                        echo "</div></div>";
                }
                else{
                    echo "<div class=\"main-card\">
                    <h2>Ventilateurs</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Processeurs</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Disque dur</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Cartes graphiques</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                        <h2>Cartes mères</h2>
                        <div class=\"main-card-content\">
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>
                        </div>
                    </div>";
                }
                ?>
                
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>