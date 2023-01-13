CREATE OR REPLACE PROCEDURE AjouterPanier
(
	p_user		 Panier.emailuser%TYPE,
	p_idProd  	 Produit.idproduit%TYPE,
	p_quant      Panier.quantite%TYPE
)
IS
BEGIN
	INSERT INTO Panier (emailuser, idproduit, quantite)
	VALUES (p_user, p_idProd, p_quant);
	COMMIT;
	DBMS_OUTPUT.PUT_LINE('Article ajouté au panier');
EXCEPTION
	WHEN DUP_VAL_ON_INDEX THEN
		DBMS_OUTPUT.PUT_LINE('Cet article est déjà dans le panier');
		UPDATE Panier
		SET quantite = quantite + p_quant
		WHERE idproduit = p_idProd
		AND emailuser = p_user;
		COMMIT;
END;
/



-- TRIGGER INSERTION DANS DETAILCOMMANDE VA CHANGE LE MONTANT DE LA COMMANDE


CREATE OR REPLACE TRIGGER t_iud_commande_maj_montant
AFTER INSERT OR DELETE OR UPDATE OF quantite
ON DetailCommande
FOR EACH ROW
DECLARE
	v_prix Produit.prixproduit%TYPE;
BEGIN
	IF DELETING OR UPDATING THEN
		SELECT prixproduit INTO v_prix
		FROM Produit P
		WHERE P.idproduit = :OLD.idproduit;
		UPDATE Commande
		SET montant = montant - (:OLD.quantite * v_prix)
		WHERE Commande.idcommande = :OLD.idcommande;
	END IF;

	IF INSERTING OR UPDATING THEN 
		-- on supprime et on remet la ligne car quantite varie mais sans suppression
		SELECT prixproduit INTO v_prix
		FROM Produit P
		WHERE P.idproduit = :NEW.idproduit;
		UPDATE Commande
		SET montant = montant + (:NEW.quantite * v_prix)
		WHERE Commande.idcommande = :NEW.idcommande;
	END IF;
END;
/


-- TRIGGER MAJ DE STOCK

CREATE OR REPLACE TRIGGER t_i_produit_maj_stock
AFTER INSERT
ON DetailCommande
FOR EACH ROW
BEGIN
    IF INSERTING THEN
        UPDATE Produit
        SET stockproduit = stockproduit - :OLD.quantite
        WHERE Produit.idproduit = :OLD.idproduit;
    END IF;
END;
/

-- Procedure de passage de commande avec le panier d'un utilisateur

CREATE OR REPLACE PROCEDURE PasserCommande(p_emailUser VARCHAR, p_idCB VARCHAR, p_idAdr VARCHAR, p_troisFois NUMBER) IS
	email_exists NUMBER;
BEGIN
	SELECT COUNT(*) INTO email_exists
	FROM Utilisateur
	WHERE emailUser = p_emailUser;

	IF email_exists != 1 THEN
		raise_application_error(-20001,'p_emailUser ('||p_emailUser||') ne correspond à aucun email dans la base');
	END IF;

	IF p_troisFois NOT BETWEEN 0 AND 1 THEN
		raise_application_error(-20002,'p_troisFois ('||p_troisFois||') doit être compris entre 0 et 1');
	END IF;

	INSERT INTO COMMANDE(IDCOMMANDE, EMAILUSER, IDCB, IDADRESSE, TROISFOIS, TAUXTVA)
	VALUES (COMMANDE_SEQ.NEXTVAL, p_emailUser, p_idCB, p_idAdr, p_troisFois, 15);

    FOR produit IN (SELECT * FROM Panier WHERE Panier.EMAILUSER = p_emailUser) LOOP
		
		INSERT INTO DETAILCOMMANDE (
			IDCOMMANDE,
			IDPRODUIT,
			QUANTITE
		)
		VALUES
		(
			COMMANDE_SEQ.CURRVAL,
			produit.idProduit,
			produit.quantite
		);

	END LOOP;
	
	DELETE FROM Panier
	WHERE Panier.EMAILUSER = emailUser;
END;
/

-- TRIGGER CHECK COMMANDE

CREATE OR REPLACE TRIGGER t_i_commande_check
BEFORE INSERT
ON Commande
FOR EACH ROW
DECLARE
	cb_appartient NUMBER;
	adr_appartient NUMBER;
BEGIN
	SELECT COUNT(*)
	INTO cb_appartient
	FROM CarteBancaire CB
	WHERE CB.idCB = :NEW.IDCB
	AND CB.emailUser = :NEW.emailUser;

	IF cb_appartient != 1 THEN
		raise_application_error(-20003,'La carte '||:NEW.idCB||' n''existe pas ou n''appartient pas à l''utilisateur');
	END IF;

    SELECT COUNT(*)
	INTO adr_appartient
	FROM Adresse ADR
	WHERE ADR.idAdresse = :NEW.idAdresse
	AND ADR.emailUser = :NEW.emailUser;

	IF ADR_appartient != 1 THEN
		raise_application_error(-20004,'L''adresse '||:NEW.idAdresse||' n''existe pas ou n''appartient pas à l''utilisateur');
	END IF;
END;
/