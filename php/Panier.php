<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
extract($_POST);
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
                    <!-- SELECT FROM Panier WHERE jsp-->
                    <div class="main-card-panier">
                        <div class="produit">
                            <div>IMAGE</div>
                            <div class="produit-info">
                                <div>Nom produit</div>
                                <div>Qte</div>
                                <div>Prix</div>
                            </div>
                            <div><button>Supprimer</button></div>
                        </div>
                        <div class="produit">
                            <div>IMAGE</div>
                            <div class="produit-info">
                                <div>Nom produit</div>
                                <div>Qte</div>
                                <div>Prix</div>
                            </div>
                            <div><button>Supprimer</button></div>
                        </div>
                    </div>
                </div>
                <div class="main-card-acheter">
                    <a href="Achat.php">Passer la commande</a>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>