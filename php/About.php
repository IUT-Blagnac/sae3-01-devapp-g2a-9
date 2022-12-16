<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
    </head>
    <body>
        <div class="content">
            <?php $page = strtolower(basename(__FILE__, '.php')); $page = strtolower(basename(__FILE__, '.php')); include("include/header.php"); ?>
            <main>
                <div class="main-card">
                    <h2>Notre entreprise</h2>
                    <p>Paragraphe explicatif</p>
                </div>
                <div class="main-card">
                    <h2>Actualité</h2>
                    <p>Paragraphe explicatif</p>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </body>
</html>