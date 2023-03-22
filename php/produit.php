<?php
    session_start();
    include('include/connect_inc.php');
    if(!$_SESSION["connected"]) header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");

    
    $id = htmlspecialchars($_GET['identifiantP']);
    
    if (isset($_POST['ajout'])) {
        $query = "begin AjouterPanier(:user, :idproduit, 1); end;";
        $stid = oci_parse($conn, $query);

        oci_bind_by_name($stid, ":user", $_SESSION['email']);
        oci_bind_by_name($stid, ":idproduit", $_POST['ajout']);

        oci_execute($stid);
        oci_free_statement($stid);
        echo "<script>alert('Article ajouté au panier');</script>";
    }

    //prix + description
    $query = "SELECT NOMPRODUIT, PRIXPRODUIT, DESCPRODUIT, IDPRODUIT, IDSOUSCAT FROM produit WHERE idproduit = :id";
    $stid = oci_parse($conn, $query);

    oci_bind_by_name($stid, ":id", $id);

    oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $res[] = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'desc' => $row['DESCPRODUIT'], 'souscat' => $row['IDSOUSCAT']];
    }

    oci_free_statement($stid);

    // si produit non existant
    if (empty($res)) {
        header("Location: index.php");
    }


    //produits similaires
    $query = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT, IDSOUSCAT FROM produit WHERE IDSOUSCAT LIKE :souscat";
    $stid2 = oci_parse($conn, $query);

    oci_bind_by_name($stid2, ":souscat", $res[0]['souscat']);
    oci_execute($stid2);

    while ($row2 = oci_fetch_array($stid2, OCI_ASSOC)) {
        $res2[] = ['nom' => $row2['NOMPRODUIT'], 'id'=> $row2['IDPRODUIT'], 'prix' => $row2['PRIXPRODUIT'], 'idsouscat2' => $row2['IDSOUSCAT']];
    }

    oci_free_statement($stid2);
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
                    <?php
                    echo "<h2>".$res[0]['nom']."</h2>"; //nom produit
                    ?>
                    <div class="main-card-produit">
                        <div class="gallerie">
                            <a class="doigt">👈</a>
                            <?php
                                echo"<img src=\"./img/produits/".$res[0]['id']."_1.jpg\" alt=\le Produit\" class=\"img_produit\">";
                            ?>
                            <a class="autredoigt">👉</a>
                            <?php
                                echo"<script> 
                                    var nbImg = 0;
                                    document.querySelector(\".doigt\").onclick = function(){
                                        if(nbImg== 0){
                                            document.querySelector(\".img_produit\").src = \"./img/produits/".$res[0]['id']."_2.jpg\";
                                            nbImg = 1;
                                        } else {
                                            document.querySelector(\".img_produit\").src = \"./img/produits/".$res[0]['id']."_1.jpg\";
                                            nbImg = 0;
                                        }
                                    };
                                    document.querySelector(\".autredoigt\").onclick = function(){
                                        if(nbImg== 0){
                                            document.querySelector(\".img_produit\").src = \"./img/produits/".$res[0]['id']."_2.jpg\";
                                            nbImg = 1;
                                        } else {
                                            document.querySelector(\".img_produit\").src = \"./img/produits/".$res[0]['id']."_1.jpg\";
                                            nbImg = 0;
                                        }
                                    };
                                </script>";
                            ?>
                        </div>
                        <h3 class="description_produit">Description :</h3>
                        
                        <?php
                            echo "<div><p><a><strong>".$res[0]['desc']."</strong></a></p></div>";
                        ?>
                        <h2>                       
                            <?php
                                echo "<div><p><a><strong>".$res[0]['prix']."</strong></a></p></div>";
                            ?>
                        </h2>
                        <div class="bouton_acheter">
                            <form method="post">
                                <button type="submit" name="ajout" value="<?= $id; ?>">Ajout panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>