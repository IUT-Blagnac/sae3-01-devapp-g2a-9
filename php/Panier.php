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
$sum = 0;
$bonjour = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW|OCI_ASSOC);

oci_free_statement($stid);
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
                        <?php if(!empty($res)): ?>
                            <?php foreach($res as $produit): ?>
                                <?php $sum += $produit['PRIXPRODUIT']; ?>
                                <div class="produit">
                                    <img src="<?= "./img/produits/".$produit['IDPRODUIT']."_1.jpg"; ?>" alt="image">
                                    <div class="produit-info">
                                        <div><?= $produit['NOMPRODUIT']; ?></div>
                                        <div><?= $produit['QUANTITE']; ?></div>
                                        <div><?= $produit['PRIXPRODUIT']."€"; ?></div>
                                    </div>
                                    <div><button>Supprimer</button></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h3>Votre panier est vide!</h3>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="main-card acheter">
                    <h2>Sous-total: <?= $sum; ?> €</h2>
                    <a href="Achat.php"><button>Passer la commande</button></a>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>