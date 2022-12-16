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
                        <a href="Categories.php?cat=cpu" class="categorie"><button>Processeurs</button></a>
                        <a href="Categories.php?cat=hdd" class="categorie"><button>Disques durs</button></a>
                        <a href="Categories.php?cat=gpu" class="categorie"><button>Cartes graphiques</button></a>
                        <a href="Categories.php?cat=mb" class="categorie"><button>Cartes mères</button></a>
                        <a href="Categories.php?cat=ventirad" class="categorie"><button>Ventilateurs</button></a>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST["cat"])) {
                    $categorie = $_REQUEST["cat"];
                    switch ($categorie) {
                        case "cpu":
                            echo "<div class=\"main-card\">
                                <h2>Processeurs</h2>
                                <div class=\"main-card-content\">
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                </div>
                            </div>";
                            break;
                        case "hdd":
                            echo "<div class=\"main-card\">
                            <h2>Disques durs</h2>
                            <div class=\"main-card-content\">
                                <div class=\"produit\">
                                    <div><a>Nom produit</a></div>
                                    <div><a>Image</a></div>
                                    <div><a>Prix</a></div>
                                    <div><button>Acheter</button></div>
                                </div>
                                <div class=\"produit\">
                                    <div><a>Nom produit</a></div>
                                    <div><a>Image</a></div>
                                    <div><a>Prix</a></div>
                                    <div><button>Acheter</button></div>
                                </div>
                                <div class=\"produit\">
                                    <div><a>Nom produit</a></div>
                                    <div><a>Image</a></div>
                                    <div><a>Prix</a></div>
                                    <div><button>Acheter</button></div>
                                </div>
                                <div class=\"produit\">
                                    <div><a>Nom produit</a></div>
                                    <div><a>Image</a></div>
                                    <div><a>Prix</a></div>
                                    <div><button>Acheter</button></div>
                                </div>
                                <div class=\"produit\">
                                    <div><a>Nom produit</a></div>
                                    <div><a>Image</a></div>
                                    <div><a>Prix</a></div>
                                    <div><button>Acheter</button></div>
                                </div>
                            </div>
                        </div>";
                            break;
                        case "gpu":
                            echo "<div class=\"main-card\">
                                <h2>Cartes graphiques</h2>
                                <div class=\"main-card-content\">
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                </div>
                            </div>";
                            break;
                        case "mb":
                            echo "<div class=\"main-card\">
                                <h2>Cartes mères</h2>
                                <div class=\"main-card-content\">
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                    <div class=\"produit\">
                                        <div><a>Nom produit</a></div>
                                        <div><a>Image</a></div>
                                        <div><a>Prix</a></div>
                                        <div><button>Acheter</button></div>
                                    </div>
                                </div>
                            </div>";
                            break;
                        case "ventirad":
                            echo "<div class=\"main-card\">
                                    <h2>Ventilateurs</h2>
                                    <div class=\"main-card-content\">
                                        <div class=\"produit\">
                                            <div><a>Nom produit</a></div>
                                            <div><a>Image</a></div>
                                            <div><a>Prix</a></div>
                                            <div><button>Acheter</button></div>
                                        </div>
                                        <div class=\"produit\">
                                            <div><a>Nom produit</a></div>
                                            <div><a>Image</a></div>
                                            <div><a>Prix</a></div>
                                            <div><button>Acheter</button></div>
                                        </div>
                                        <div class=\"produit\">
                                            <div><a>Nom produit</a></div>
                                            <div><a>Image</a></div>
                                            <div><a>Prix</a></div>
                                            <div><button>Acheter</button></div>
                                        </div>
                                        <div class=\"produit\">
                                            <div><a>Nom produit</a></div>
                                            <div><a>Image</a></div>
                                            <div><a>Prix</a></div>
                                            <div><button>Acheter</button></div>
                                        </div>
                                        <div class=\"produit\">
                                            <div><a>Nom produit</a></div>
                                            <div><a>Image</a></div>
                                            <div><a>Prix</a></div>
                                            <div><button>Acheter</button></div>
                                        </div>
                                    </div>
                                </div>";
                            break;
                    }
                }
                else{
                    echo "<div class=\"main-card\">
                    <h2>Ventilateurs</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>                            
                            <div><button>Acheter</button></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Processeurs</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Disque dur</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                    <h2>Cartes graphiques</h2>
                    <div class=\"main-card-content\">
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                        <div class=\"produit\">
                            <div><a>Nom produit</a></div>
                            <div><a>Image</a></div>
                            <div><a>Prix</a></div>
                            <div><button>Acheter</button></div>
                        </div>
                    </div>
                </div>
                <div class=\"main-card\">
                        <h2>Cartes mères</h2>
                        <div class=\"main-card-content\">
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><button>Acheter</button></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><button>Acheter</button></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><button>Acheter</button></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><button>Acheter</button></div>
                            </div>
                            <div class=\"produit\">
                                <div><a>Nom produit</a></div>
                                <div><a>Image</a></div>
                                <div><a>Prix</a></div>
                                <div><button>Acheter</button></div>
                            </div>
                        </div>
                    </div>";
                }
                ?>
                
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>