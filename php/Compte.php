<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if(!$_SESSION["connected"]) header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");
extract($_POST);
include("include/connect_inc.php");

//Utilisateur
$query = "SELECT * FROM UTILISATEUR WHERE EMAILUSER LIKE :email";
$stid = oci_parse($connect, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

$res = oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC)){
    $email = $row['EMAILUSER'];
    $nom = $row['NOMUSER'];
    $prenom = $row['PRENOMUSER'];
    $tel = $row['TELUSER'];
}


//Ajout CB
if(isset($addCB)){
    if (!preg_match("/[0-9]{16}/", $numcb)) $erreur = "Numéro de carte bancaire invalide.";
    else if (!preg_match("/.{1,64}/",$nomcb)) $erreur = "Nom invalide.";
    else if (!preg_match("/[0-9]{0,4}/", $cryptocb)) $erreur = "Cryptogramme invalide.";
    else{
        $query = "INSERT INTO CARTEBANCAIRE (idCb, numeroCb, nomCb, dateCb, cryptoCb, emailuser)
        VALUES(CB_SEQ.NEXTVAL, :numeroCb, :nomCb, TO_DATE(:dateCb,'YYYY-MM-DD'), :cryptoCb, :emailuser)";
        $stid = oci_parse($connect, $query);

        oci_bind_by_name($stid, ":numeroCb", $numcb);
        oci_bind_by_name($stid, ":nomCb", $nomcb);
        oci_bind_by_name($stid, ":dateCb", $datecb);
        oci_bind_by_name($stid, ":cryptoCb", $cryptocb);
        oci_bind_by_name($stid, ":emailUser", $_SESSION['email']);

        $res = oci_execute($stid);

        header("Location: Compte.php");
    }
}


//Ajout Adresse
if(isset($addAdresse)){
    if (!preg_match("/.{0,64}/", $alias)) $erreur = "Alias invalide.";
    else if (!preg_match("/.{1,45}/",$ville)) $erreur = "Nom de ville invalide.";
    else if (!preg_match("/.{1,128}/",$adresse)) $erreur = "Adresse invalide.";
    else if (!preg_match("/[0-9]{5}/",$code_postal)) $erreur = "Code-postal invalide.";
    else if (!preg_match("/.{0,64}/",$complement)) $erreur = "Complément d'adresse invalide.";
    else{
        $query = "INSERT INTO ADRESSE (idAdresse, surnomadresse, ville, adresse, codepostal, complement, emailuser)
        VALUES(ADRESSE_SEQ.NEXTVAL, :alias, :ville, :adresse, :code_postal, :complement, :emailuser)";
        $stid = oci_parse($connect, $query);

        oci_bind_by_name($stid, ":alias", $alias);
        oci_bind_by_name($stid, ":ville", $ville);
        oci_bind_by_name($stid, ":adresse", $adresse);
        oci_bind_by_name($stid, ":code_postal", $code_postal);
        oci_bind_by_name($stid, ":complement", $complement);
        oci_bind_by_name($stid, ":emailUser", $_SESSION['email']);

        $res = oci_execute($stid);

        header("Location: Compte.php");
    }
}


//Supprimer CB
if(isset($delCB)){
    $query = "DELETE FROM CARTEBANCAIRE WHERE IDCB LIKE :idCB AND EMAILUSER LIKE :email";
    $stid = oci_parse($connect, $query);

    oci_bind_by_name($stid, ":idCB", $idCB);
    oci_bind_by_name($stid, ":email", $_SESSION['email']);

    $res = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);

    header("Location: Compte.php");
}

//Supprimer Adresse
if(isset($delAdresse)){
    $query = "DELETE FROM ADRESSE WHERE IDADRESSE LIKE :idAdresse AND EMAILUSER LIKE :email";
    $stid = oci_parse($connect, $query);

    oci_bind_by_name($stid, ":idAdresse", $idAdresse);
    oci_bind_by_name($stid, ":email", $_SESSION['email']);

    $res = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);

    header("Location: Compte.php");
}

//Affichage CB
$query = "SELECT * FROM CARTEBANCAIRE WHERE EMAILUSER LIKE :email";
$listecb = oci_parse($connect, $query);

oci_bind_by_name($listecb, ":email", $_SESSION['email']);

$res = oci_execute($listecb);

//Affichage Adresse
$query = "SELECT * FROM ADRESSE WHERE EMAILUSER LIKE :email";
$listeadresses = oci_parse($connect, $query);

oci_bind_by_name($listeadresses, ":email", $_SESSION['email']);

$res = oci_execute($listeadresses);

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

            <div class="align-left"><form style="all: initial;" action="session_destroy.php" method="POST"><div class="round_button"><input style="background-color: rgba(255, 0, 0, 0.5);" class="social" type="submit" value="DÉCONNEXION" /></div></form></div>

                <div class="main-card">
                    <?php
                        echo isset($erreur) ? "<p id=\"erreur_connexion\">$erreur</p>" : '';
                        echo isset($erreur_res) ? "<p id=\"erreur_connexion\">$erreur</p>" : '';
                    ?>
                    <h1 style="text-align: center">Compte Utilisateur <span style="position:relative; top: -.1em;">🙋</span></h1>
                    <div class="zone-utilisateur">
                        <div class="bulle" style="height: fit-content">
                            <img src="img/pécé.jpg" alt="Image Utilisateur" id="image-utilisateur">
                            <h3><?php echo ucwords($prenom)." ".ucwords($nom) ?></h3>
                        </div>
                        <div class="bulle">
                            <div class="label-value">
                                <label for="prenom" style="margin-top:0;">Prénom</label>
                                <input value=<?php echo"\"".ucwords($prenom)."\"" ?> id="prenom" disabled/>
                            </div>

                            <div class="label-value">
                                <label for="nom" style="margin-top:0;">Nom</label>
                                <input value=<?php echo"\"".ucwords($nom)."\"" ?> id="nom" disabled/>
                            </div>
                            
                            <div class="label-value">
                                <label for="email" style="margin-top:0;">Adresse Email</label>
                                <input value=<?php echo"\"".$email."\"" ?> id="email" disabled/>
                            </div>

                            <div class="label-value">
                                <label for="numero-telephone" style="margin-top:0;">N° Téléphone</label>
                                <input value=<?php echo"\"".ucwords($tel)."\"" ?> id="numero-telephone" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    
                    <h1  style="text-align: center">Méthodes de paiement <span style="position:relative; top: -.1em;">💳</span></h1>
                    <div class="zone-utilisateur">
                        <?php
                        while ($row = oci_fetch_array($listecb, OCI_ASSOC)) {
                            echo "<div class=\"bulle\">
                                <div class=\"carte-bancaire\">
                                    <label for=\"nom-carte-bancaire\" style=\"margin-top:0;\">Nom</label>
                                    <input value=\"{$row['NOMCB']}\" id=\"nom-carte-bancaire\" disabled/>

                                    <label for=\"numero-carte-bancaire\">Numéro de Carte Bancaire</label>
                                    <input id=\"numero-carte-bancaire\" value=\"".substr($row['NUMEROCB'],0,4)." XXXX XXXX XXXX\" disabled>
                                
                                    <label for=\"cryptogramme-carte-bancaire\">Cryptogramme visuel</label>
                                    <input value=\"".substr($row['CRYPTOCB'],0,1)."XX\" id=\"cryptogramme-carte-bancaire\" disabled/>

                                    <label for=\"cryptogramme-carte-bancaire\">Date d'expiration</label>
                                    <input value=\"{$row['DATECB']}\" id=\"date-carte-bancaire\" disabled/>

                                    <label for=\"submit\"></label>
                                    <form method=\"post\" style=\"all: initial;\">
                                        <input type=\"hidden\" name=\"idCB\" value=\"{$row['IDCB']}\">
                                        <input type=\"submit\" name=\"delCB\" value=\"🗑️ Supprimer la carte\" style=\"background-color: rgba(255, 0, 0, 0.5); cursor: pointer;\">
                                    </form>
                                </div>
                            </div>
                            ";
                        }
                        ?>
                        
                        <div class="bulle 妈妈">
                            <div class="carte-bancaire">
                                <form method="post" style="all: initial">
                                    <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                                    <input placeholder="Demeyere" id="nom-carte-bancaire" pattern=".{1,64}" name="nomcb"/>
                                    
                                    <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                                    <input id="numero-carte-bancaire" pattern="[0-9]{16}" name="numcb" placeholder="1234567812345678">

                                    <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                                    <input placeholder="123" pattern="[0-9]{0,4}" id="cryptogramme-carte-bancaire" name="cryptocb"/>

                                    <label for="date-carte-bancaire">Date d'expiration</label>
                                    <input type="date" id="start" name="datecb" value="2023-02-27" min="2000-01-01">
                                    
                                    <label for="submit"></label>
                                    <input type="submit" name="addCB" value="➕ Ajouter la carte" style="background-color: rgba(42, 153, 14, 0.5);cursor: pointer;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    <h1  style="text-align: center">Adresses de livraison <span style="position:relative; top: -.1em;">📫</span></h1>
                    <div class="zone-utilisateur">
                        <?php
                            while ($row = oci_fetch_array($listeadresses, OCI_ASSOC)) { echo "<div class=\"bulle\">
                                <div class=\"carte-bancaire\">

                                    <label for=\"nom-adresse-livraison\" style=\"margin-top:0;\">Alias de l'adresse</label>
                                    <input value=\"{$row['SURNOMADRESSE']}\" id=\"nom-adresse-livraison\" disabled/>
                                    
                                    <label for=\"ville-adresse-livraison\">Ville</label>
                                    <input id=\"ville-adresse-livraison\" value=\"{$row['VILLE']}\" disabled>
                                    
                                    <label for=\"code-postal-adresse-livraison\">Code Postal</label>
                                    <input id=\"code-postal-adresse-livraison\" value=\"{$row['CODEPOSTAL']}\" disabled>
                                
                                    <label for=\"adresse-adresse-livraison\">Adresse</label>
                                    <input id=\"adresse-adresse-livraison\" value=\"{$row['ADRESSE']}\" disabled>
                                    
                                    <label for=\"complement-adresse-livraison\">Complément</label>
                                    <input id=\"complement-adresse-livraison\" value=\"{$row['COMPLEMENT']}\" disabled>

                                    <label for=\"submit\"></label>
                                    <form method=\"post\" style=\"all: initial;\">
                                        <input type=\"hidden\" name=\"idAdresse\" value=\"{$row['IDADRESSE']}\">
                                        <input type=\"submit\" name=\"delAdresse\" value=\"🗑️ Supprimer l'adresse\" style=\"background-color: rgba(255, 0, 0, 0.5); cursor: pointer;\">
                                    </form>
                                </div>
                            </div>";
                            }
                        ?>
                        <div class="bulle">
                            <div class="carte-bancaire">
                                <form method="post" style="all: initial">
                                    <label for="nom-adresse-livraison" style="margin-top:0;">Alias de l'adresse</label>
                                    <input placeholder="Chez tonton Patrick 🐐" name="alias" pattern=".{0,64}" id="nom-adresse-livraison"/>

                                    <label for="ville-adresse-livraison">Ville</label>
                                    <input id="ville-adresse-livraison" pattern=".{1,45}" name="ville" placeholder="Toulouse">

                                    <label for="code-postal-adresse-livraison">Code Postal</label>
                                    <input id="code-postal-adresse-livraison" pattern="[0-9]{5}" name="code_postal" placeholder="31000">
                                    
                                    <label for="adresse-adresse-livraison">Adresse</label>
                                    <input id="adresse-adresse-livraison" name="adresse" pattern=".{1,128}" placeholder="28 Allée des potirons">
                                    
                                    <label for="complement-adresse-livraison">Complément</label>
                                    <input id="complement-adresse-livraison" name="complement" pattern=".{0,64}" placeholder="">

                                    <label for="submit"></label>
                                    <input type="submit" name="addAdresse" value="➕ Ajouter l'adresse" style="background-color: rgba(42, 153, 14, 0.5);cursor: pointer;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>