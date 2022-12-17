<?php
	// on inclut le fichier de connexion à la base Oracle
	require_once("connect.inc.php");
	error_reporting(0);
	
	// si la connexion a réussi...
	// on crée une variable pour la définition de la requête : tous les joueurs français triés par nom, prenom
	$req1 = "SELECT * FROM Joueur WHERE ne = 'FRA' ORDER BY NOMJ, PREJ";
		
	/* 
		Les instructions ci-dessous sont spécifiques dans PHP lorsqu'on veut travailler avec une base Oracle
		Mais elles reprennent la même logique que ce que l'on a fait en TP PHP : prepare((), execute()...
	*/
	
	// on prépare la requête
    $lesJoueursFr = oci_parse($connect, $req1);
	// on execute la requete
 	$result = oci_execute($lesJoueursFr);
	// si erreur de requete alors affichage...
	if (!$result) {
		$e = oci_error($lesJoueursFr);  // on récupère l'exception liée au pb d'execution de la requete
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
	}

	// si pas d'erreur alors on parcourt le curseur résultat pour affichage en PHP
	echo "<H1> Les Joueurs de l'équipe de France par ordre alphabétique</H1>";
	while (($leJoueurFr = oci_fetch_assoc($lesJoueursFr)) != false) {
		echo $leJoueurFr['PREJ']." ".$leJoueurFr['NOMJ']; 
	    echo "<br/>";
	}
	
	// Libère toutes les ressources réservées par un résultat Oracle
	oci_free_statement($lesJoueursFr);


/////////////////////////////////////////////////////////////////////////////////
	// on va créer une requete paramétrée
	$req2 = "SELECT * FROM Joueur WHERE ne = 'FRA' and pst = :pPst ORDER BY NOMJ, PREJ";
	// on prépare la requête
    $lesPiliersFrancais = oci_parse($connect, $req2);
		
	// il faut passer par une variable pour contenir la valeur
	$pst = "Pilier"; 
	// on lie la valeur au paramètre de la requête
	oci_bind_by_name($lesPiliersFrancais, ":pPst", $pst);
	
	// on execute la requete
 	$result = oci_execute($lesPiliersFrancais);
	// pas d'erreur Oracle ici car un select qui ne ramene rien n'est pas une erreur, c'est un résultat...

	//  on parcourt le curseur résultat pour affichage en PHP
	echo "<H1> Les Piliers de l'équipe de France par ordre alphabétique</H1>";
	while (($lePilierFr = oci_fetch_assoc($lesPiliersFrancais)) != false) {
		echo $lePilierFr['PREJ']." ".$lePilierFr['NOMJ']." est un ".$lePilierFr['PST']." français"; 
	    echo "<br/>";
	}
	// Libère toutes les ressources réservées par un résultat Oracle
	oci_free_statement($lesPiliersFrancais);

/*

	//////////////////////////////////////////////////////////////////////////////////
	// on crée une autre variable pour la définition d'une requête paramétrée d'insertion
	$req3 = "INSERT INTO Joueur (nj, prej, nomj, ne) VALUES(:pNj, :pPrej, :pNomJ, :pNe)";						 
	// on prépare la requête paramétrée
	$insertJoueur = oci_parse($connect, $req3);
	// on associe les valeurs aux paramètres de la requête via des variables (sinon ça marche pas !)
	$nj = 300; 	$prej = "Patricia"; $nomj = "Stolf" ; $ne = "FRA";
	oci_bind_by_name($insertJoueur, ":pNj", $nj);
	oci_bind_by_name($insertJoueur, ":pPreJ", $prej);
	oci_bind_by_name($insertJoueur, ":pNomJ", $nomj );
	oci_bind_by_name($insertJoueur, ":pNe", $ne);
	// on execute la requete
	$result = oci_execute($insertJoueur);
	// si erreur de requete alors affichage...
	if (!$result) {
		$e = oci_error($insertJoueur);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
	}
	// vérifiez l'insertion dans SQL developer avec cette requete : select * from joueur where nj > 299;
	// on commit les modifs faites
	oci_commit($connect);
	
	// Libère toutes les ressources réservées par un résultat Oracle
	oci_free_statement($insertJoueur);
*/

/*
	// on supprime la ligne précédemment ajoutée (stolf...)
	$req4 = "DELETE FROM Joueur WHERE nj = 300";						 
	// on prépare la requête paramétrée
	$deleteJoueur = oci_parse($connect, $req4);
	// on execute la requete
	$result = oci_execute($deleteJoueur);
	// pas d'erreur Oracle ici car un delete qui ne fait rien n'est pas une erreur
	// on commit les modifs faites
	oci_commit($connect);
	// Libère toutes les ressources réservées par un résultat Oracle
	oci_free_statement($deleteJoueur);
	// vérifiez l'insertion dans SQL developer avec cette requete : select * from joueur where nj > 299;
*/


	//////////////////////////////////////////////////////////////////////////////////////////////
	// on crée une autre variable pour l'appel d'une fonction stockée dans un package avec passage param et valeur retour
	echo "<H1> Nb points marqués par une équipe </H1>";
	$req = " begin :retour := Gestion_Rugby.retournePointsMarques(:pNe); end; ";
	$appelFunctStock = oci_parse($connect, $req);
	// on définit la valeur du paramètre en entrée de la fonction
	$ne = "Irlande";
	oci_bind_by_name($appelFunctStock, ':pNe', $ne);
	
	// on définit la variable qui va récupérer la valeur retournée par la fonction stockée
	// le dernier paramètre definit la longueur maximale pour la variable récupérée
	oci_bind_by_name($appelFunctStock, ':retour', $retour, 40);
	$result = oci_execute($appelFunctStock);
	
	if (!$result) {
		// on récupère l'exception liée au pb d'execution de la fonction (no data found pour cette équipe)
		$e = oci_error($appelFunctStock);  
		print htmlentities($e['message'].' pour la fonction : '.$e['sqltext']);
		echo "</BR></BR></BR></BR>";		
	}
	else {
		echo "</BR></BR> Nb points marqués par les joueurs de l'Irlande : ".$retour."</BR>";   // Affiche 168 
		echo "</BR></BR></BR></BR>";
	}
	oci_free_statement($appelFunctStock);
	oci_close($connect);
	
	// D'autres exemples d'utilisation d'OCI ici :  https://www.php.net/manual/fr/oci8.examples.php
	
?>
