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
                    <h2>*Nom produit*</h2>
                    <div class="main-card-content">
                        <div class="gallerie">
                            <a class="doigt">👈</a>
                            <img src="./img/pécé.jpg" alt="le Produit" class="img_produit">
                            <a class="doigt">👉</a>
                        </div>
                        <h3>Description :</h3>
                        <p>Informations technique: La saucisse fraîche devrait être composée d'environ 70% de viande maigre comparativement à 30% de gras (proportions idéales). Le pourcentage de gras peut varier de 25 à 30%. Moins de 15%, la saucisse sera trop dure, trop élevée en protéine, pas assez juteuse. Par opposition, si le pourcentage de gras est au-dessus de 30%, la perte de gras à la cuisson sera excessive et le produit de moindre qualité. Pour moins de 15%, un liant approprié doit être utilisé. La bajoue est une qualité de viande plus difficile à utiliser pour la saucisse fraîche, dû à la présence possible de bactéries nuisibles ou d'abcès (il est préférable d'utiliser la bajoue pour les produits cuits. Ex: creton)</p>
                        <a>*Prix du produit*</a>
                        <button>Acheter</button>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>