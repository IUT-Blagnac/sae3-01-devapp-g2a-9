<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="resources/images/logo.png">
    </head>

    <body>
        <div class="content">
            <?php include("header.html"); ?>
            <main>
                <div class="main-card">
                    <h2>Catégories</h2>
                    <div class="main-card-content">
                        <div class="categorie"><button>Processeurs</button></div>
                        <div class="categorie"><button>Disques durs</button></div>
                        <div class="categorie"><button>Cartes graphiques</button></div>
                        <div class="categorie"><button>Cartes mères</button></div>
                        <div class="categorie"><button>Ventilateurs</button></div>
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
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
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
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class="produit">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("footer.html"); ?>
        </div>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </body>
</html>