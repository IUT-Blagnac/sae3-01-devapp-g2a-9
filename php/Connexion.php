<?php 
    session_start();
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
                    <div class="social">
                        <div class="alternate">Inscription</div>
                    </div>
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
        
    </body>
</html>
<!-- partie traitement -->
<?php 
extract($_POST);
if (isset($valider)) {
    // SELECT emailUser, mdpUser FROM User WHERE emailUser = ? 
    // bind $email
    // $res = stat->exec
    // if (empty($res)) erreur = email non connu
    // if (!verify_password($password, $res['mdpUser'])) erreur = mdp non connu
    // else :
    if ($email == "user@a.com" && $pass == "123") {
        if (isset($souvenir)) {
            setcookie('email', $email, time() + 60*60*24*30); // un mois
        }
        $_SESSION["autoriser"] = "oui";
        header("Location: index.php");
    } else {
        $erreur = "mauvais login ou mdp";
    }
}
?>