<html lang="fr">
    <head>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
        <?php
            $query = "SELECT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC FROM produit P";

            if (isset($_GET['recherche'])){
                $recherche =  htmlspecialchars($_GET['recherche']);
                $query .= " WHERE NOMPRODUIT ='".$recherche."'";
            } else {
                $recherche = '';
            }
            // if (isset($_GET['categorieRecherchee'])){
            //     $categorieRecherchee = htmlspecialchars($_GET['categorieRecherchee']);
            // } else {
            //     $categorieRecherchee = '';
            // }
            // if (isset($_GET['categorieRecherchee'])){
            //     $categorieRecherchee = htmlspecialchars($_GET['categorieRecherchee']);
            // } else {
            //     $categorieRecherchee = '';
            // }
            // if (isset($_GET['sousCategorieRecherchee'])){
            //     $sousCategorieRecherchee = htmlspecialchars($_GET['sousCategorieRecherchee']);
            // } else {
            //     $sousCategorieRecherchee = '';
            // }
            // if (isset($_GET['prixMin'])){
            //     $prixMin = htmlspecialchars($_GET['prixMin']);
            // } else {
            //     $prixMin = '';
            // }
            // if (isset($_GET['prixMax'])){
            //     $prixMax = htmlspecialchars($_GET['prixMax']);
            // } else {
            //     $prixMax = '';
            // }


             

            session_start();
            $db = "(DESCRIPTION =
            (ADDRESS = (PROTOCOL = TCP)(HOST = oracle.iut-blagnac.fr)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SID = db11g)
            )
            )";
            $conn = oci_connect("SAEBD09", "M0ntBlanc1UT", $db);
            //requete sql
            if ($recherche == ''){
                // $query = "SELECT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC FROM produit P";
                $titreRecherche = "Tout les produits :";
            } else {
                // $query = "SELECT NOMPRODUIT, IDPRODUIT, PRIXPRODUIT, (PRIXPRODUIT - REDUCTION) as REDUC FROM produit WHERE NOMPRODUIT ='".$recherche."'";
                $titreRecherche = "Résultats de la recherche :";
            }
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                $res[] = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'reduc' => $row['REDUC']];
            }
            oci_free_statement($stid);
            oci_close($conn);
        ?>
        <div class="content">
            <?php $page = strtolower(basename(__FILE__, '.php')); include("include/header.php"); ?>
            <main>
                <div class="barre-de-recherche">
                    <div class="barre-de-recheche">
                        <label for="barre-de-recherche">Rechercher</label>
                        <form action="Recherche.php" method="get">
                            <input type="text" name="recherche" placeholder="Nom du produit">
                            <select name="categorieRecherchee">
                                <option value=""selected>Catégorie</option>
                                <option value="01">Processeurs</option>
                                <option value="02">Stockage mémoire</option>
                                <option value="03">Cartes graphiques</option>
                                <option value="04">Cartes meres</option>
                                <option value="05">Ventilateurs</option>
                            </select>
                            <select name="sousCategorieRecherchee">
                                <option value=""selected>Sous Catégorie</option>
                                <option value="00A">SousCat1</option>
                                <option value="00B">SousCat2</option>
                            </select>
                            <input type="number" name="prixMin" placeholder="Prix minimum">
                            <input type="number" name="prixMax" placeholder="Prix maximum">
                            <input type="submit" value="Rechercher 🔎">
                        </form>
                    </div>
                </div>
                <?php
                        // permet de desactiver les messages d'erreurs. Enlever des commentaires quand dev fini
                        // error_reporting(0);
                        if (!is_null($res) or isset($res)) {
                            echo"<div class=\"main-card\">
                            <h2>".$titreRecherche."</h2>
                            <div class=\"main-card-content\">";
                            foreach($res as $produit) { 
                                echo" <div class=\"produit\">
                            <div><a><strong>".$produit['nom']."</strong></a></div>
                            <div class=\"image-produit-content\"><img class=\"image-produit\"src=\"./img/produits/".$produit['id']."_1.jpg\" alt=\"Image du produit\"></div>";
                            if($produit['reduc'] != $produit['prix']){
                                echo"<div><a class=\"reduc\">".$produit['prix']." €</a></div>
                                <div><a>".$produit['reduc']." €</a></div>";
                            } else{
                                echo"<div><a>".$produit['prix']." €</a></div>";
                            }
                            echo"<div><a href=\"produit.php\"><button>Acheter</button></a></div>
                            </div>";
                            }
                            echo"</div>";
                        } else {
                            echo"<div class=\"main-card\">
                            <h2>Désolé nous n'avons pas de ".$_GET['recherche']." en stock :(</h2>";
                        }
                ?>
            </main>
            <?php include("include/footer.html"); ?>
        </div>
        <?php include("include/background.html"); ?>
    </body>
</html>