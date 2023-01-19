
drop table DetailCommande;
drop table commande;
drop table carteBancaire;
drop table panier;
drop table produit;
drop table sousCategorie;
drop table categorie;
drop table adresse;
drop table utilisateur;

create table utilisateur (
    emailUser varchar(64),
    mdpUser varchar(256),
    adminUser number(1),
    nomUser varchar(64),
    prenomUser varchar(64),
    telUser char(10),
    COMPTEENTREPRISE NUMBER(1) CHECK (COMPTEENTREPRISE between 0 and 1),
    CONSTRAINT pk_utilisateur PRIMARY KEY (emailUser)
);

create table adresse(
    idAdresse varchar(20),
    surnomAdresse varchar(64),
    adresse varchar(128),
    complement varchar(64),
    ville varchar(45),
    codePostal char(5),
    emailUser varchar(64),
    CONSTRAINT pk_adresse PRIMARY KEY (idAdresse),
    CONSTRAINT fk_adresse_user FOREIGN KEY (emailUser) REFERENCES utilisateur(emailUser)
);

create table categorie(
    idCat VARCHAR(20),
    nomCat VARCHAR(64),
    descCat VARCHAR(256),
    CONSTRAINT pk_idCat PRIMARY KEY (idCat)
);

create table sousCategorie(
    idSousCat VARCHAR(20),
    nomSousCat VARCHAR(64),
    descSousCat VARCHAR(256),
    idCat VARCHAR(20),
    CONSTRAINT pk_sousCat PRIMARY KEY (idSousCat),
    CONSTRAINT fk_sousCat_idCat FOREIGN KEY (idCat) REFERENCES categorie(idCat)
);
create table produit(
    idProduit  VARCHAR(20),
    nomProduit VARCHAR(64),
    descProduit VARCHAR(256),
    prixProduit DECIMAL(9,2),
    dateProduit DATE,
    stockProduit DECIMAL(9,2),
    reduction DECIMAL(9,2),
    imageProduit DECIMAL(9,2),
    idSousCat VARCHAR(20),
    CONSTRAINT pk_produit PRIMARY KEY (idProduit),
    CONSTRAINT fk_produit_sousCat FOREIGN KEY (idSousCat) REFERENCES sousCategorie(idSousCat)
);
create table panier(
    emailUser varchar(64),
    idProduit VARCHAR(20),
    quantite DECIMAL(4),
    CONSTRAINT pk_panier PRIMARY KEY (idProduit, emailUser),
    CONSTRAINT fk_panier_idProduit FOREIGN KEY (idProduit) REFERENCES produit(idProduit),
    CONSTRAINT fk_panier_emailUser FOREIGN KEY (emailUser) REFERENCES utilisateur(emailUser)
);
create table carteBancaire (
    idCB VARCHAR(20),
    numeroCB CHAR(16),
    nomCB VARCHAR(64),
    dateCB DATE,
    cryptoCB VARCHAR(4),
    emailUser varchar(64),
    CONSTRAINT pk_carteBancaire PRIMARY KEY (idCB),
    CONSTRAINT fk_carteBancaire_emailUser FOREIGN KEY (emailUser) REFERENCES utilisateur(emailUser)
);
create table commande (
    idCommande VARCHAR(20),
    emailUser varchar(64),
    idCB VARCHAR(20),
    idAdresse varchar(20),
    troisFois DECIMAL(1),
    tauxTVA DECIMAL(3),
    montant DECIMAL(11,2),
    CONSTRAINT pk_commande PRIMARY KEY (idCommande),
    CONSTRAINT fk_commande_emailUser FOREIGN KEY (emailUser) REFERENCES utilisateur(emailUser),
    CONSTRAINT fk_commande_idCB FOREIGN KEY (idCB) REFERENCES carteBancaire(idCb),
    CONSTRAINT fk_commande_idAdress FOREIGN KEY (idAdresse) REFERENCES adresse(idAdresse)
);
CREATE TABLE DetailCommande (
    idCommande VARCHAR(20),
    idProduit VARCHAR(20),
    quantite NUMBER(4),
    CONSTRAINT pk_detailcommande PRIMARY KEY (idCommande, idProduit),
    CONSTRAINT fk_detailcommande_idcomm FOREIGN KEY (idCommande) REFERENCES Commande(idCommande),
    CONSTRAINT fk_detailcommande_idprod FOREIGN KEY (idProduit) REFERENCES Produit(idProduit)
);