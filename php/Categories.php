<?php 
error_reporting(E_ERROR | E_PARSE);
include("include/connect_inc.php");

//categories
$query = "SELECT NOMCAT, IDCAT FROM CATEGORIE";
$stid = oci_parse($connect, $query);
oci_execute($stid);

while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
    $categories[] = [ 'NOMCAT' => $row['NOMCAT'], 'IDCAT' => $row['IDCAT'] ];
}


// Produits par catégorie
if (isset($_REQUEST["cat"])) {
    $query = "SELECT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC, C.IDCAT FROM produit P, categorie C, SOUSCATEGORIE S WHERE P.IDSOUSCAT = S.IDSOUSCAT AND C.IDCAT = S.IDCAT AND C.IDCAT = :categorie";
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
else{
    foreach ($categories as $categorie_produit) {
        $query = "SELECT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC, C.IDCAT FROM produit P, categorie C, SOUSCATEGORIE S WHERE P.IDSOUSCAT = S.IDSOUSCAT AND C.IDCAT = S.IDCAT AND C.IDCAT = :categorie AND ROWNUM < 3";
        $stid = oci_parse($connect, $query);

        oci_bind_by_name($stid, ":categorie", $categorie_produit);

        $res = oci_execute($stid);

        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            $produits[$categorie_produit] = ['nom' => $row['NOMPRODUIT'], 'id' => $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'reduc' => $row['REDUC']];
        }
        oci_free_statement($stid);
        oci_close($conn);
    }
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
                                echo " <a href=\"Categories.php?cat=" . $i['IDCAT'] . "\" class=\"categorie\"><button>".ucwords($i['NOMCAT'])."</button></a>";
                            }
                        ?>
                    </div>
                </div>
                <?php
                //Obtenir le nom de la categorie selectionnée
                foreach ($categories as $categorie) {
                    if ($categorie['IDCAT'] == $_REQUEST["cat"]) {
                        $nomcat = $categorie['NOMCAT'];
                    }
                }

                if (isset($_REQUEST["cat"])) {
                    echo "<div class=\"main-card\">
                        <h2>" . ucwords($nomcat) . "</h2>
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
                    foreach ($categories as $categorie) {
                        $nomcat = $categorie['NOMCAT'];
                        echo "
                        <div class=\"main-card\">
                            <h2>" . ucwords($nomcat) . "</h2>
                            <div class=\"main-card-content\">
                                <div class=\"produit\">
                                    <div><a><strong>".$produit[$categorie]['nom']."</strong></a></div>
                                    <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit[$categorie]['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                    <div><a>".$produit[$categorie]['prix']." €</a></div>
                                    <div><a href=\"produit.php\"><button>Acheter</button></a></div>
                                </div>
                            </div>
                        </div>";
                    }
                }
                ?>
                
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>