<?php
error_reporting(E_ERROR | E_PARSE);
if(!session_status() != PHP_SESSION_ACTIVE){
    header("Location: Connexion.php?origine=".basename(__FILE__, '.php').".php");
}
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
            <div class="align-left"><a href="Compte.php?edit" class="social">MODIFIER</a></div>
                <div class="main-card">
                    <h1 style="text-align: center">Compte Utilisateur <span style="position:relative; top: -.1em;">🙋</span></h1>
                    <div class="zone-utilisateur">
                        <div class="bulle">
                            <img src="img/pécé.jpg" alt="Image Utilisateur" id="image-utilisateur">
                            <h3>Nicolas Vion</h3>
                        </div>
                        <div class="bulle">
                            <div class="label-value">
                                <label for="prenom" style="margin-top:0;">Prénom</label>
                                <input value="Nicolas" id="prenom" disabled/>
                            </div>

                            <div class="label-value">
                                <label for="nom" style="margin-top:0;">Nom</label>
                                <input value="Vion" id="nom" disabled/>
                            </div>
                            
                            <div class="label-value">
                                <label for="email" style="margin-top:0;">Adresse Email</label>
                                <input value="anton.xu@yvelin.net" id="email" disabled/>
                            </div>

                            <div class="label-value">
                                <label for="numero-telephone" style="margin-top:0;">N° Téléphone</label>
                                <input value="07 71 22 21 47" id="numero-telephone" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    <h1  style="text-align: center">Méthodes de paiement <span style="position:relative; top: -.1em;">💳</span></h1>
                    <div class="zone-utilisateur">
                        <div class="bulle">
                            <div class="carte-bancaire">
                            
                                <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                                <input value="Demeyere" id="nom-carte-bancaire" disabled/>

                                <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                                <input id="numero-carte-bancaire" value="4973 XXXX XXXX XXXX" disabled>
                            
                                <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                                <input value="4XX" id="cryptogramme-carte-bancaire" disabled/>
                                
                                <label class="checkbox-label" for="paiement-3-fois">
                                <input type="checkbox" name="paiement-3-fois" id="paiement-3-fois" checked disabled>
                                Paiement en 3 fois
                                </label>
                            </div>
                        </div>
                        <div class="bulle">
                            <div class="carte-bancaire">
                            
                                <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                                <input value="Prochaska" id="nom-carte-bancaire" disabled/>

                                <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                                <input id="numero-carte-bancaire" value="8473 XXXX XXXX XXXX" disabled>
                            
                                <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                                <input value="2XX" id="cryptogramme-carte-bancaire" disabled/>
                                
                                <label class="checkbox-label" for="paiement-3-fois">
                                <input type="checkbox" name="paiement-3-fois" id="paiement-3-fois" disabled>
                                Paiement en 3 fois
                                </label>
                            </div>
                        </div>
                        <div class="bulle">
                            <div class="carte-bancaire">

                                <label for="nom-carte-bancaire" style="margin-top:0;">Nom</label>
                                <input value="Xu" id="nom-carte-bancaire" disabled/>

                                <label for="numero-carte-bancaire">Numéro de Carte Bancaire</label>
                                <input id="numero-carte-bancaire" value="3630 XXXX XXXX XXXX" disabled>
                            
                                <label for="cryptogramme-carte-bancaire">Cryptogramme visuel</label>
                                <input value="6XX" id="cryptogramme-carte-bancaire" disabled/>
                                
                                <label class="checkbox-label" for="paiement-3-fois">
                                <input type="checkbox" name="paiement-3-fois" id="paiement-3-fois" checked disabled>
                                Paiement en 3 fois
                                </label>
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