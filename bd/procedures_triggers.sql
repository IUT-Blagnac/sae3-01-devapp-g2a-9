CREATE OR REPLACE PROCEDURE AjouterPanier
(
	p_idProd  	 Produit.idproduit%TYPE,
	p_quant      Panier.quantite%TYPE,
	p_user		 Panier.emailuser%TYPE
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

-- CACA PIPI


CREATE OR REPLACE PROCEDURE PasserCommande(emailUser VARCHAR, idCB VARCHAR, idAdr VARCHAR, troisFois NUMBER) IS

BEGIN
	INSERT INTO COMMANDE(IDCOMMANDE, EMAILUSER, IDCB, IDADRESSE, TROISFOIS, TAUXTVA)
	VALUES (COMMANDE_SEQ.NEXTVAL, emailUser, idCB, idAdr, troisFOIS, 15);

    FOR produit IN (SELECT * FROM Panier WHERE Panier.EMAILUSER = emailUser) LOOP
		
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