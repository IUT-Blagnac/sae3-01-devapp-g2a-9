<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
include("include/connect_inc.php");
if(!$_SESSION["connected"]) header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");
extract($_POST);

$query = "SELECT Pr.idProduit, nomProduit, prixProduit, reduction, quantite
          FROM Produit Pr, Panier Pa
          WHERE Pr.idProduit = Pa.idProduit
          AND Pa.emailUser = :email";

$stid = oci_parse($conn, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

oci_execute($stid);

$res = [];
$bonjour = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW|OCI_ASSOC);

$e = oci_error($stid);

oci_free_statement($stid);
echo "<pre>";
echo "bonjour : $bonjour";
print_r($res);
echo htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
echo "</pre>";
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
                    <h2>Panier</h2>
                    <div class="main-card-panier">
                        <?php foreach($res as $produit): ?>
                            <div class="produit">
                                <img src="<?php echo "./img/produits/".$produit['idProduit']."_1.jpg"; ?>" alt="image">
                                <div class="produit-info">
                                    <div><?php echo $produit['nomProduit']; ?></div>
                                    <div><?php echo $produit['quantite']; ?></div>
                                    <div><?php echo $produit['prixProduit']; ?></div>
                                </div>
                                <div><button>Supprimer</button></div>
                            </div>
                        <?php endforeach; ?>
                        <div class="produit">
                            <img src="img/test-gpu.png" alt="image">
                            <div class="produit-info">
                                <div>Nom produitee</div>
                                <div>6</div>
                                <div>Prix</div>
                            </div>
                            <div><button>Supprimer</button></div>
                        </div>
                        <div class="produit">
                            <img src="img/test-gpu.png" alt="image">
                            <div class="produit-info">
                                <div>Nom produit</div>
                                <div>2</div>
                                <div>150,99 €</div>
                            </div>
                            <div><button>Supprimer</button></div>
                        </div>
                    </div>
                </div>
                <div class="main-card acheter">
                    <h2>Sous-total: 500,00 €</p>
                    <a href="Achat.php"><button>Passer la commande</button></a>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>