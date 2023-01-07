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
    if ($email == "user@a.com" && $password == "123") {
        if (isset($souvenir)) {
            setcookie('email', $email, time() + 60*60*24*30); // un mois
        }
        $_SESSION["autoriser"] = "oui";
        header("Location: index.php");
    } else {
        $erreur = "Email incorrect ou déjà assignée";
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
                    <h3>Inscription Utilisateur</h3>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="sushi18@pouet.com" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" id="email"/>
                   
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="∗∗∗∗∗∗∗∗∗∗∗∗∗∗∗" id="password"/>

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" placeholder="Clint" id="prenom"/>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" placeholder="Orris" id="nom"/>

                    <label for="numtel">Numéro de téléphone</label>
                    <input type="tel" name="numtel" placeholder="0612345678" id="numtel"/>
                    <label class="checkbox-label" for="entreprise">
                        <input type="checkbox" name="entreprise" id="entreprise">
                        Compte entreprise
                    </label>
                    
                    <button type="submit" name="valider">Inscription</button>

                    <?php echo isset($erreur) ? "<p id=\"erreur_connexion\">Adresse email déjà utilisée</p>" : '';?>

                    <a class="alternate social" href="Connexion.php">Connexion</a>
                        
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
        
    </body>
</html>
