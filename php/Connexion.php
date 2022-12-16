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
                    
                    <label class="checkbox-label" for="souvenir">
                        <input type="checkbox" name="souvenir" id="souvenir">
                        Se souvenir de moi
                    </label>

                    <button type="submit" name="valider">Connexion</button>
                    <div class="social">
                        <div class="alternate">Mot de passe oublié</div>
                        <div class="alternate">Inscription</div>
                    </div>
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
    </body>
</html>
<!-- partie traitement -->
<?php 
extract($_POST);
if (isset($valider)) {
    if ($login == "user" && $pass == "123") { //ne pas oublier de hash le mdp
        setcookie('email', $email, time() + 60*60*24*30);
        $_SESSION["autoriser"] = "oui";
        header("Location: index.php");
    } else {
        $erreur = "mauvais login ou mdp";
    }
}
?>