<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
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
                <div class="main-card">
                    <h1 style="text-align: center">Compte Utilisateur</h1>
                    <h2>Profil</h2>
                    <div class="zone-utilisateur">
                        <div class="bulle">
                            <img src="img/pécé.jpg" alt="Image Utilisateur" id="image-utilisateur">
                            <h3>Nicolas Vion</h3>
                        </div>
                        <div class="bulle">
                            
                        </div>
                    </div>
                </div>
                <div class="main-card">
                    <h2 style="margin-bottom:2vmin">Méthodes de paiement <span style="position:relative; top: -.1em;">💳</span></h2>
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
                    </div>
                </div>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
    
</html>