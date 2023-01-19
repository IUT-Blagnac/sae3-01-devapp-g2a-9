<?php
	// on inclut le fichier de connexion à la base Oracle
	require_once("connect.inc.php");
	error_reporting(0);
	
	// si la connexion a réussi...
	// on crée une variable pour la définition de la requête : tous les joueurs français triés par nom, prenom
	$req1 = "SELECT nomproduit FROM produit WHERE dateproduit BETWEEN ADD_MONTHS(sysdate, -6) and sysdate;";
	// on prépare la requête
    $allProd = oci_parse($conn, $req1);
	// on execute la requete
 	$result = oci_execute($allProd);
	// si erreur de requete alors affichage...
	if (!$result) {
		$e = oci_error($allProd);  // on récupère l'exception liée au pb d'execution de la requete
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
	}

	while (($oneProd = oci_fetch_assoc($allProd)) != false) {
		echo $oneProd['PREJ']." ".$oneProd['NOMJ']; 
	    echo "<br/>";
	}
	// Libère toutes les ressources réservées par un résultat Oracle
	oci_free_statement($allProd);