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

if (!$res) {
    $e = oci_error($stid);  // on récupère l'exception liée au pb d'execution de la requete
    $error_res = htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);	
}

while($row = oci_fetch_array($stid, OCI_ASSOC)){
    $email = $row['EMAILUSER'];
    $nom = $row['NOMUSER'];
    $prenom = $row['PRENOMUSER'];
    $tel = $row['TELUSER'];
}

//Cartes bancaires
$query = "SELECT * FROM CARTEBANCAIRE WHERE EMAILUSER LIKE :email";
$stid = oci_parse($connect, $query);

oci_bind_by_name($stid, ":email", $_SESSION['email']);

$res = oci_execute($stid);

if (!$res) {
    $e = oci_error($stid);  // on récupère l'exception liée au pb d'execution de la requete
    $error_res = htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);	
}
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

            <div class="align-left"><a href="Compte.php?edit" class="social">MODIFIER</a><form style="all: unset;" action="session_destroy.php" method="POST"><input style="background-color: rgba(255, 0, 0, 0.5);" class="social" type="submit" value="DÉCONNEXION" /></form></div>
            <?php
                echo isset($erreur) ? "<p id=\"erreur_connexion\">$erreur</p>" : '';
                echo isset($erreur_res) ? "<p id=\"erreur_connexion\">$erreur</p>" : '';
            ?>

                <div class="main-card">
                    <h1 style="text-align: center">Compte Utilisateur <span style="position:relative; top: -.1em;">🙋</span></h1>
                    <div class="zone-utilisateur">
                        <div class="bulle">
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
                        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                            echo "<div class=\"bulle\">
                                <div class=\"carte-bancaire\">
                                    <form method=\"post\" style=\"all: none;\">
                                        <input type=\"hidden\" name=\"idCB\" value=\"{$row['IDCB']}\">
                                        <input type=\"submit\" name=\"delCB\" value=\"🗑️\" class=\"emoji_modification\">
                                    </form>
                                    <label for=\"nom-carte-bancaire\" style=\"margin-top:0;\">Nom</label>
                                    <input value=\"{$row['NOMCB']}\" id=\"nom-carte-bancaire\" disabled/>

                                    <label for=\"numero-carte-bancaire\">Numéro de Carte Bancaire</label>
                                    <input id=\"numero-carte-bancaire\" value=\"".substr($row['NUMEROCB'],0,4)."XXXX XXXX XXXX\" disabled>
                                
                                    <label for=\"cryptogramme-carte-bancaire\">Cryptogramme visuel</label>
                                    <input value=\"".substr($row['CRYPTOCB'],0,1)."XX\" id=\"cryptogramme-carte-bancaire\" disabled/>

                                    <label for=\"cryptogramme-carte-bancaire\">Cryptogramme visuel</label>
                                    <input value=\"{$row['DATECB']}\" id=\"cryptogramme-carte-bancaire\" disabled/>
                                </div>
                            </div>
                            ";
                        }
                        ?>
                        
                        <div class="bulle">
                            <div class="carte-bancaire">
                                <form method="post">
                                    <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                                    <input placeholder="Demeyere" id="nom-carte-bancaire"/>
                                    <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                                    <input id="numero-carte-bancaire" placeholder="4973 XXXX XXXX XXXX">
                                    <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                                    <input placeholder="4XX" id="cryptogramme-carte-bancaire"/>
                                    
                                    <label class="checkbox-label" for="paiement-3-fois">
                                    <input type="checkbox" name="paiement-3-fois" id="paiement-3-fois">
                                    Paiement en 3 fois
                                    </label>
                                    <input type="submit" name="addCB" value="➕" class="emoji_modification">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    <h1  style="text-align: center">Adresses de livraison <span style="position:relative; top: -.1em;">📫</span></h1>
                    <div class="zone-utilisateur">
                    <div class="bulle">
                            <div class="carte-bancaire">

                                <label for="nom-adresse-livraison" style="margin-top:0;">Alias de l'adresse</label>
                                <input value="À la maison 🏠" id="nom-adresse-livraison" disabled/>

                                <label for="code-postal-adresse-livraison">Code Postal</label>
                                <input id="code-postal-adresse-livraison" value="31700" disabled>

                                <label for="ville-adresse-livraison">Ville</label>
                                <input id="ville-adresse-livraison" value="Blagnac" disabled>
                            
                                <label for="adresse-adresse-livraison">Adresse</label>
                                <input id="adresse-adresse-livraison" value="2 Bis Rue des Potiers" disabled>
                                
                                <label for="complement-adresse-livraison">Complément</label>
                                <input id="complement-adresse-livraison" value="Appartement n°7" disabled>
                            </div>
                        </div>
                        <div class="bulle">
                            <div class="carte-bancaire">

                                <label for="nom-adresse-livraison" style="margin-top:0;">Alias de l'adresse</label>
                                <input value="Chez tonton Patrick 🐐" id="nom-adresse-livraison" disabled/>

                                <label for="code-postal-adresse-livraison">Code Postal</label>
                                <input id="code-postal-adresse-livraison" value="31000" disabled>

                                <label for="ville-adresse-livraison">Ville</label>
                                <input id="ville-adresse-livraison" value="Toulouse" disabled>
                            
                                <label for="adresse-adresse-livraison">Adresse</label>
                                <input id="adresse-adresse-livraison" value="28 Allée des potirons" disabled>
                                
                                <label for="complement-adresse-livraison">Complément</label>
                                <input id="complement-adresse-livraison" value="" disabled>
                            </div>
                        </div>
                        <div class="bulle">
                            <div class="carte-bancaire">

                                <label for="nom-adresse-livraison" style="margin-top:0;">Alias de l'adresse</label>
                                <input value="Ancien Appartement 🏢" id="nom-adresse-livraison" disabled/>

                                <label for="code-postal-adresse-livraison">Code Postal</label>
                                <input id="code-postal-adresse-livraison" value="34000" disabled>

                                <label for="ville-adresse-livraison">Ville</label>
                                <input id="ville-adresse-livraison" value="Montpellier" disabled>
                            
                                <label for="adresse-adresse-livraison">Adresse</label>
                                <input id="adresse-adresse-livraison" value="14 Avenue Kennedy" disabled>
                                
                                <label for="complement-adresse-livraison">Complément</label>
                                <input id="complement-adresse-livraison" value="Appartement n°23" disabled>
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