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
                    <h2>Catégories</h2>
                    <div class="main-card-content">
                        <a href="Categories.php?cat=cpu" class="categorie"><button>Processeurs</button></a>
                        <a href="Categories.php?cat=hdd" class="categorie"><button>Disques durs</button></a>
                        <a href="Categories.php?cat=gpu" class="categorie"><button>Cartes graphiques</button></a>
                        <a href="Categories.php?cat=mb" class="categorie"><button>Cartes mères</button></a>
                        <a href="Categories.php?cat=ventirad" class="categorie"><button>Ventilateurs</button></a>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Nouveautés</h2>
                    <!-- SELECT FROM Produit WHERE date jsp-->
                    <div class="main-card-content">
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    <h2>Soldes</h2>
                    <!-- SELECT FROM Produit WHERE reduc > 0 -->
                    <div class="main-card-content">
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><a href="produit.php"><button>Acheter</button></a></div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>