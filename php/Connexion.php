<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php 
session_start();
extract($_POST);
if (isset($valider)) {
    // SELECT emailUser, mdpUser FROM User WHERE emailUser = ? 
    // bind $email
    // $res = stat->exec
    // if (empty($res)) erreur = email non connu
    // if (!verify_password($password, $res['mdpUser'])) erreur = mdp non connu
    // else :
    if (empty($res["emailUser"])) {
        $erreur = "Adresse Email inconnue";
    } else {
        if (password_verify($password, $res['mdpUser'])){
            if (isset($souvenir)) setcookie('email', $email, time() + 60*60*24*30); // Retenir l'email pendant un mois

            $_SESSION["autoriser"] = "oui"; // Valider la session

            // Rediriger vers la page d'origine ou l'index
            if (isset($_GET["origine"])) header("Location: $_GET{\"origine\"}.php");
            else header("Location: index.php");
        }
        else{
            $erreur = "Mot de passe invalide";
        }
    }
}
?>

<!-- partie html -->

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
                <form method="post">
                    <h3>Connexion Utilisateur</h3>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="sushi18@pouet.com" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" id="email"/>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="∗∗∗∗∗∗∗∗∗∗∗∗∗∗∗" id="password"/>
                    <a id="mdp_oublie" href="reset_mdp.php">Mot de passe oublié</a>
                    
                    <label class="checkbox-label" for="souvenir">
                        <input type="checkbox" name="souvenir" id="souvenir">
                        Se souvenir de moi
                    </label>

                    <button type="submit" name="valider">Connexion</button>

                    <?php echo isset($erreur) ? "<p id=\"erreur_connexion\">Le mot de passe ou l'email est incorrect</p>" : '';?>

                    <a class="alternate social" href="Inscription.php">Inscription</a>
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
        
    </body>
</html>
