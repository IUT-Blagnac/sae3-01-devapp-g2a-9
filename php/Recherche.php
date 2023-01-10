<html lang="fr">
    <head>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
        <?php
            if (isset($_GET['recherche'])){
                $recherche =  htmlspecialchars($_GET['recherche']);
                session_start();
                $db = "(DESCRIPTION =
                            (ADDRESS = (PROTOCOL = TCP)(HOST = oracle.iut-blagnac.fr)(PORT = 1521))
                            (CONNECT_DATA =
                              (SERVER = DEDICATED)
                              (SID = db11g)
                            )
                          )";
                $conn = oci_connect("SAEBD09", "M0ntBlanc1UT", $db);
                //requete sql
                $query = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT, (PRIXPRODUIT - REDUCTION) as REDUC FROM produit WHERE NOMPRODUIT ='".$recherche."'";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                    $res[] = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'reduc' => $row['REDUC']];
                }
                oci_free_statement($stid);
                oci_close($conn);
            }
        ?>
        <div class="content">
            <?php $page = strtolower(basename(__FILE__, '.php')); include("include/header.php"); ?>
            <main>
                <div class="barre-de-recherche">
                    <div class="barre-de-recheche">
                        <label for="barre-de-recherche">Rechercher</label>
                        <form action="Recherche.php" method="get">
                            <input type="text" name="recherche" placeholder="Nom du produit">
                        </form>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Résultats de la recherche</h2>
                    <div class="main-card-content">
                    <?php
                            if (isset($_GET['recherche'])){
                            foreach($res as $produit) { 
                                echo" <div class=\"produit\">
                                <div><a><strong>".$produit['nom']."</strong></a></div>
                                <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                <div><a>".$produit['prix']." €</a></div>
                                <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                                </div>";
                            }
                        }
                        ?>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>