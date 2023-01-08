<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php 
session_start();
extract($_POST);
if (isset($valider)) {
    $db = "(DESCRIPTION =
            (ADDRESS = (PROTOCOL = TCP)(HOST = oracle.iut-blagnac.fr)(PORT = 1521))
            (CONNECT_DATA =
              (SERVER = DEDICATED)
              (SID = db11g)
            )
          )";
    $conn = oci_connect("SAEBD09", "M0ntBlanc1UT", $db);

    //EMAIL
    $query = "SELECT * FROM UTILISATEUR WHERE EMAILUSER LIKE '$email'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    if ($row = oci_fetch_array($stid, OCI_ASSOC)){
         $res["emailUser"] = true;
         $res["mdpUser"] = $row['MDPUSER'];
    }
    else $res["emailUser"] = false;

    //print(password_hash("aB12345", PASSWORD_DEFAULT)); // Pour hasher un mdp

    oci_free_statement($stid);
    oci_close($conn);

    if (!$res["emailUser"]) {
        $erreur = "Adresse Email inconnue";
    } else {
        if (password_verify($password, $res['mdpUser'])){
            if (isset($souvenir)) setcookie('email', $email, time() + 60*60*24*30); // Retenir l'email pendant un mois

            $_SESSION["connected"] = true; // Valider la session

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

                    <?php echo isset($erreur) ? "<p id=\"erreur_connexion\">$erreur</p>" : '';?>

                    <a class="alternate social" href="Inscription.php">Inscription</a>
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
        
    </body>
</html>
