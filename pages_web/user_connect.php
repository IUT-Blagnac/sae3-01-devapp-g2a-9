<?php 
    session_start();
?>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="logo.ico">
    </head>

    <body>
        <div class="content">
            <?php include("header.html"); ?>
            <main>
                <form method="post">
                    <h3>Connexion Utilisateur</h3>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="sushi18@gmail.com" id="email"/>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="***********" id="password"/>
                    <input type="checkbox" name="souvenir" id="souvenir">
                    <label for="souvenir">Se souvenir de moi</label>
                    <button type="submit" name="conn">Connexion</button>
                    <div class="social">
                        <div class="alternate">Mot de passe oublié</div>
                        <div class="alternate">Inscription</div>
                    </div>
                </form>
            </main>
            <?php include("footer.html"); ?>
        </div>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>


<?php 
    $login = $_POST["email"];
    $mdp = $_POST['password'];
    $valider = $_POST["valider"];
    $erreur = "";

    if (isset($valider)) {
        if ($login == "user" && $pass == "123") { //ne pas oublier de hash le mdp
            $_SESSION["autoriser"] = "oui";
            header("Location: index.php");
        } else {
            $erreur = "mauvais login ou mdp";
        }
    }
 
?>

    </body>
    </html>