<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
    </head>
    <body>
        <div class="content">
            <?php include("include/header.php"); ?>
            <main class="apropos">
                <div class="main-card">
                    <h2>Contacts généraux</h2>
                    <p>
                        Adresse : 12 Avenue de la Douze Touldouse</br>
                        Email : <a href="mailto:contact@cdlr.fr" style="text-decoration: underline; color: lightblue;">contact@cdlr.fr</a></br>
                        <a href="https://www.youtube.com/watch?v=xqnZPHo6qx4">Téléphone :</a><span alt="COPIER" style="color: lightblue; cursor: pointer; text-decoration: underline;" onclick="navigator.clipboard.writeText('+33 4 56 39 82 90');">+33 4 56 39 82 90</span>
                        <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=3%20Brasseurs%20Blagnac,%20Rue%20Denis%20Diderot,%2031700%20Blagnac+()&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
                    </p>
                </div>
                <div class="main-card">
                    <h2>Service Client</h2>
                    <p>
                       Pour toute demande relative au site internet et autres demandes, merci de contacter le service client à l'adresse email <a href="mailto:service-client@cdlr.fr" style="text-decoration: underline; color: lightblue;">service-client@cdlr.fr</a></br>
                       Si la demande est urgente, vous pouvez nous contacter par téléphone, durant les heures d'ouverture des magasins au <span alt="COPIER" style="color: lightblue; cursor: pointer; text-decoration: underline;" onclick="navigator.clipboard.writeText('+33 4 56 39 82 90');">+33 4 56 39 82 90</span>.
                    </p>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>