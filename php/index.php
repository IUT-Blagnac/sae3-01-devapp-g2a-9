<?php
    session_start();
    include('include/connect_inc.php');

    //categories
    $query = "SELECT nomcat FROM categorie";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res[] = $row['NOMCAT'];
    }
    
    
    //nouveautées
    $query2 = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT FROM produit WHERE dateproduit BETWEEN ADD_MONTHS(sysdate, -6) and sysdate and rownum <= 4";
    $stid2 = oci_parse($conn, $query2);
    oci_execute($stid2);
    
    while ($row2 = oci_fetch_array($stid2, OCI_ASSOC)) {
        $res2[] = ['nom' => $row2['NOMPRODUIT'], 'id'=> $row2['IDPRODUIT'], 'prix' => $row2['PRIXPRODUIT']];
    }

    // produits en réductions
    $query3 = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT, (PRIXPRODUIT - REDUCTION) as REDUC FROM produit WHERE reduction > 0 and rownum <= 4";
    $stid3 = oci_parse($conn, $query3);
    oci_execute($stid3);
    
    while ($row3 = oci_fetch_array($stid3, OCI_ASSOC)) {
        $res3[] = ['nom' => $row3['NOMPRODUIT'], 'id'=> $row3['IDPRODUIT'], 'prix' => $row3['PRIXPRODUIT'], 'reduc' => $row3['REDUC']];
    }

    oci_free_statement($stid);
    oci_free_statement($stid2);
    oci_free_statement($stid3);
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
                    <h2>Nouveautés</h2>
                    <div class="main-card-content">
                        
                            <?php
                                foreach($res2 as $produit) { 
                                    echo" <div class=\"produit\">
                                    <div><a><strong>".$produit['nom']."</strong></a></div>
                                    <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                    <div><a>".$produit['prix']." €</a></div>
                                    <form name= \"aie\" action=\"produit.php\" method= \"get\">
                                    <div><button name = \"identifiantP\"type= \"submit\" value= ".$produit['id'].">Acheter</button></div>
                                    </form>
                                    </div>";
                                }
                            ?>
                        
                    </div>
                </div>
                <div class="main-card">
                    <h2>Soldes</h2>
                    <div class="main-card-content">                        
                        <?php
                            foreach($res3 as $produit) { 
                                echo" <div class=\"produit\">
                                <div><a><strong>".$produit['nom']."</strong></a></div>
                                <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>
                                <div><a class=\"reduc\">".$produit['prix']." €</a></div>
                                <div><a>".$produit['reduc']." €</a></div>
                                <form name= \"aie\" action=\"produit.php\" method= \"get\">
                                <div><button name = \"identifiantP\"type= \"submit\" value= ".$produit['id'].">Acheter</button></div>
                                </form>
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