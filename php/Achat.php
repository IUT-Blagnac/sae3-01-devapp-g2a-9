<?php
error_reporting(E_ERROR | E_PARSE); 
include("include/check_session.php");
extract($_POST);
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
                    <h3>Passer la commande</h3>

                    <label for="Adresse">Où nous livrons-vous ?</label>
                    <select name="adresse-livraison" class="custom-select">
                        <option value="">Faites un choix !</option>
                        <option value="adresse1">Rue des potiers</option>
                        <option value="adresse2">Chez moi</option>
                    </select>
                    <a class="bouton-adresse" href="Compte.php">Ajouter une adresse</a>

                    <h2 style="margin-top:2vmin">Méthode de paiement <span style="position:relative; top: -.1em;">💳</span></h2>
                    <div class="carte-bancaire">
                        <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                        <input type="text" name="nom-carte-bancaire" placeholder="Bril" id="nom-carte-bancaire"/>

                        <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                        <input id="numero-carte-bancaire" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="numero-carte-bancaire" maxlength="19" placeholder="1234 1234 1234 1234">
                    
                        <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                        <input type="tel" name="cryptogramme-carte-bancaire" inputmode="numeric" pattern="[0-9\s]{3}" placeholder="420" maxlength="3" id="cryptogramme-carte-bancaire"/>
                        
                        <label class="checkbox-label" for="paiement-3-fois">
                        <input type="checkbox" name="paiement-3-fois" id="paiement-3-fois">
                        Paiement en 3 fois
                    </label>
                    </div>
                    
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" placeholder="Nicolas" id="prenom"/>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" placeholder="Vion" id="nom"/>

                    <label for="numtel">Numéro de téléphone</label>
                    <input type="tel" name="numtel" placeholder="0612345678" id="numtel"/>
                    
                    <button type="submit" name="commander">Passer la commande</button>

                    <?php echo isset($erreur) ? "<p id=\"erreur_connexion\">Veuillez confirmer que les informations sont correctes </p>" : '';?>
                        
                </form>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>