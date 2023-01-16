<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
include("include/connect_inc.php");
if(!$_SESSION["connected"]) header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");
extract($_POST);

if (isset($_POST['commander'])) {
    $query = "begin PasserCommande(:user, :idcb, :idadr, :trois); end;";
    $stid = oci_parse($conn, $query);

    oci_bind_by_name($stid, ":user", $_SESSION['email']);
    oci_bind_by_name($stid, ":idcb", $_POST['cartebancaire']);
    oci_bind_by_name($stid, ":idadr", $_POST['adresse']);
    oci_bind_by_name($stid, ":trois", $_POST['troisfois']);

    oci_execute($stid);
    oci_free_statement($stid);
    echo "<script>alert('Votre commande a bien été passée !');</script>";
}

// Utilisateur
$query = "SELECT * FROM UTILISATEUR WHERE EMAILUSER LIKE :email";
$stid = oci_parse($conn, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

$res = oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC)){
    $nom = $row['NOMUSER'];
    $prenom = $row['PRENOMUSER'];
    $tel = $row['TELUSER'];
}

// adresses
$query = "SELECT idAdresse, surnomAdresse
          FROM Adresse
          WHERE emailUser = :email";

$stid = oci_parse($conn, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

oci_execute($stid);

$adresses = [];
oci_fetch_all($stid, $adresses, null, null, OCI_FETCHSTATEMENT_BY_ROW|OCI_ASSOC);

oci_free_statement($stid);

// cartes bancaires
$query = "SELECT idCB, numeroCB
          FROM CARTEBANCAIRE
          WHERE emailUser = :email";

$stid = oci_parse($conn, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

oci_execute($stid);

$cbs = [];
oci_fetch_all($stid, $cbs, null, null, OCI_FETCHSTATEMENT_BY_ROW|OCI_ASSOC);

oci_free_statement($stid);

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
                <form method="post" style="width: 95vmin;">
                    <h3>Passer la commande</h3>

                    <label for="Adresse">Où nous livrons-vous ?</label>
                    <select name="adresse" class="custom-select">
                        <option value="">Faites un choix !</option>
                        <?php foreach($adresses as $adr): ?>
                        <option value="<?= $adr['IDADRESSE']; ?>"><?= $adr['SURNOMADRESSE']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a class="bouton-adresse" href="Compte.php">Ajouter une adresse</a>

                    <label for="CB">Où nous livrons-vous ?</label>
                    <select name="cartebancaire" class="custom-select">
                        <option value="">Faites un choix !</option>
                        <?php foreach($cbs as $cb): ?>
                        <option value="<?= $cb['IDCB']; ?>"><?= substr($cb['NUMEROCB'],0,4)." XXXX XXXX XXXX"; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a class="bouton-adresse" href="Compte.php">Ajouter une carte</a>

                    <label class="checkbox-label" for="troisfois">
                        <input type="checkbox" name="troisfois" id="troisfois">
                        Paiement en 3 fois
                    </label>
                    
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" value="<?= ucwords($prenom); ?>" id="prenom" readonly/>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" value="<?= ucwords($nom); ?>" id="nom" readonly/>

                    <label for="numtel">Numéro de téléphone</label>
                    <input type="tel" name="numtel" value="<?= $tel; ?>" id="numtel" readonly/>
                    
                    <button type="submit" name="commander">Passer la commande</button>

                    <?php echo isset($erreur) ? "<p id=\"erreur_connexion\">Veuillez confirmer que les informations sont correctes </p>" : '';?>
                        
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>