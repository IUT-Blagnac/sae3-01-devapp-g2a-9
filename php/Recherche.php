<html lang="fr">
    <head>
        <title>Commerce de la rue</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
        <?php
            $query = "SELECT DISTINCT P.NOMPRODUIT, P.IDPRODUIT, P.PRIXPRODUIT, P.DATEPRODUIT, (P.PRIXPRODUIT - P.REDUCTION) as REDUC FROM produit P, categorie C, SOUSCATEGORIE S";

            if (isset($_GET['recherche'])){
                $recherche =  htmlspecialchars($_GET['recherche']);
            } else {
                $recherche = '';
            }
            if (isset($_GET['categorieRecherchee'])){
                $categorieRecherchee = htmlspecialchars($_GET['categorieRecherchee']);
            } else {
                $categorieRecherchee = '';
            }
            if (isset($_GET['sousCategorieRecherchee'])){
                $sousCategorieRecherchee = htmlspecialchars($_GET['sousCategorieRecherchee']);
            } else {
                $sousCategorieRecherchee = '';
            }
            if (isset($_GET['prixMin'])){
                $prixMin = htmlspecialchars($_GET['prixMin']);
            } else {
                $prixMin = '';
            }
            if (isset($_GET['prixMax'])){
                $prixMax = htmlspecialchars($_GET['prixMax']);
            } else {
                $prixMax = '';
            }
            if (isset($_GET['tri'])){
                $optionTri = htmlspecialchars($_GET['tri']);
            } else {
                $optionTri = '';
            }

             

            session_start();
            $db = "(DESCRIPTION =
            (ADDRESS = (PROTOCOL = TCP)(HOST = oracle.iut-blagnac.fr)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SID = db11g)
            )
            )";
            $conn = oci_connect("SAEBD09", "M0ntBlanc1UT", $db);
            //Construction de la requete SQL
            if ($recherche == ''){
                $titreRecherche = "Tout les produits :";
            } else {
                $query .= " WHERE NOMPRODUIT ='".$recherche."'";
                $titreRecherche = "Résultats de la recherche :";
            }
            if ($categorieRecherchee != ''){
                if ($recherche != ""){
                    $query .= " AND";
                }
                $query .= " WHERE C.IDCAT = '000".$categorieRecherchee."' AND P.IDSOUSCAT = S.IDSOUSCAT AND S.IDCAT = C.IDCAT";
                $titreRecherche = "Résultats de la recherche :";
            }
            if ($sousCategorieRecherchee != ''){
                if ($recherche != "" or $categorieRecherchee != ""){
                    $query .= " AND";
                } else {
                    $query .= " WHERE";
                }
                $query .= " P.IDSOUSCAT ='".$categorieRecherchee.$sousCategorieRecherchee."'";
                $titreRecherche = "Résultats de la recherche :";
            }
            if ($prixMin != ""){
                if ($recherche != "" or $categorieRecherchee != ""){
                    $query .= " AND";
                } else {
                    $query .= " WHERE";
                }
                $query .= " (P.PRIXPRODUIT - P.REDUCTION) >'".$prixMin."'";
                $titreRecherche = "Résultats de la recherche :";
            }
            if ($prixMax != ''){
                if ($recherche != "" or $categorieRecherchee != "" or $prixMin !=""){
                    $query .= " AND";
                } else {
                    $query .= " WHERE";
                }
                $query .= " (P.PRIXPRODUIT - P.REDUCTION) <'".$prixMax."'";
                $titreRecherche = "Résultats de la recherche :";
            }
            if ($optionTri == 0){
                $query .= " ORDER BY (P.PRIXPRODUIT - P.REDUCTION) ASC";
            } elseif ($optionTri == 1){
                $query .= " ORDER BY (P.PRIXPRODUIT - P.REDUCTION) DESC";
            } elseif($optionTri == 2){
                $query .= " ORDER BY P.NOMPRODUIT ASC";
            } elseif($optionTri == 3){
                $query .= " ORDER BY P.NOMPRODUIT DESC";
            } elseif($optionTri == 4){
                $query .= " ORDER BY P.DATEPRODUIT DESC";
            }

            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                $res[] = ['nom' => $row['NOMPRODUIT'], 'id'=> $row['IDPRODUIT'], 'prix' => $row['PRIXPRODUIT'], 'reduc' => $row['REDUC']];
            }

            //categories
            $query2 = "SELECT nomcat FROM categorie";
            $stid2 = oci_parse($conn, $query2);
            oci_execute($stid2);

            while ($row2 = oci_fetch_array($stid2, OCI_ASSOC)) {
                $res2[] = $row2['NOMCAT'];
            }

            oci_free_statement($stid);
            oci_free_statement($stid2);
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
                                <?php
                                    $i = 1;
                                    foreach ($res2 as $categorie) {
                                        echo"<option value=\"0".strval($i)."\">".$categorie."</option>";
                                        $i += 1;
                                    }
                                ?>
                            </select>
                            <select name="sousCategorieRecherchee">
                                <option value=""selected>Sous Catégorie</option>
                                <option value="00A">SousCat1</option>
                                <option value="00B">SousCat2</option>
                            </select>
                            <input type="number" name="prixMin" placeholder="Prix minimum">
                            <input type="number" name="prixMax" placeholder="Prix maximum">
                            <select name="tri">
                                <option value=""selected>Options de tri</option>
                                <option value="0">Prix 🥐</option>     
                                <option value="1">Prix dé🥐</option>     
                                <option value="2">Nom A-Z</option>     
                                <option value="3">Nom Z-A</option>     
                                <option value="4">Nouveautées</option>     
                            </select>
                            <input type="submit" value="Rechercher 🔎">
                        </form>
                    </div>
                </div>
                <?php
                        // permet de desactiver les messages d'erreurs. Enlever des commentaires quand dev fini
                        error_reporting(0);
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