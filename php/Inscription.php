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
    $query = prepare("SELECT * FROM UTILISATEUR WHERE EMAILUSER LIKE '$email'");
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    if ($row = oci_fetch_array($stid, OCI_ASSOC)){
        $erreur = "Email déjà utilisé, connectez-vous ou réinitialisez votre mot de passe.";
    }
    else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'email est incorrect.";
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $error = "Le mot de passe doit contenir ";
        }
        else if (!preg_match("/^[a-zA-Z-' ]*$/",$nom) || !preg_match("/^[a-zA-Z']+*$/",$nom)) {
            $error = "Le prénom peut seuleument contenir des lettres, des tirets et des espaces et doit au moins contenir une lettre.";
        }
        else if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom) || !preg_match("/^[a-zA-Z']+*$/",$nom)) {
            $error = "Le nom peut seuleument contenir des lettres, des tirets et des espaces et doit au moins contenir une lettre.";
        }
        else if(preg_match('/^[0-9]{8, 10}+$/', $numtel)) {
            $error = "Le numéro de téléphone doit être entre 8 et 10 chiffres.";
        }
        else{
            $query = prepare("
            INSERT INTO utilisateur (idUser,emailUser,mdpUser,adminUser,nomUser,prenomUser,telUser,compteEntreprise)
            VALUES ('drbhw70828','gravida.sagittis@outlook.ca','AFU52JUB6EJ',0,'Benton','Faith','0738755996', 0);
            ");
            $stid = oci_parse($conn, $query);
            oci_execute($stid);



            header("Location: index.php");
    }
}

    //print(password_hash("aB12345", PASSWORD_DEFAULT)); // Pour hasher un mdp

    oci_free_statement($stid);
    oci_close($conn);

    
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
