<?php
error_reporting(E_ERROR | E_PARSE); 
if(!session_status() != PHP_SESSION_ACTIVE){
    header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");
}
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
                            <img src="img/test-gpu.png" alt="image">
                            <div class="produit-info">
                                <div>Nom produit</div>
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