<?php error_reporting(E_ERROR | E_PARSE); ?>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
    </head>

    <div class="body">
        <div class="content">
            <?php include("include/header.php"); ?>
            <p style="color: transparent;   ">Il est nez sur un Élan lent avec un nez long l'an un.</p>
            <main>
                <div class="body" style="user-select:none;-webkit-user-select:none;cursor:not-allowed;text-align:center;display:flex;align-content:center;flex-direction:column;justify-content:center;font-size:3em;color:white;font-family:'Comic Sans MS';">
                    <p>Fallait pas l'oublier !</p>
                    <img src="img/motdepasseoublie.gif" alt="alt" draggable="false" style="width:60vmin;height:auto;border-radius:0.5vmin;">
                </div>
                <form action="Connexion.php" method="post">
                    <h3>Réinitialisation du mot de passe</h3>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="sushi18@pouet.com" id="email"/>
                    <a class="social" href="Connexion.php">
                        <div class="alternate">Valider</div>
                    </a>
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </div>
    
</html>