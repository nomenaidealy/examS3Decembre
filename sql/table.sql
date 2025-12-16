CREATE OR REPLACE DATABASE taxibe;
USE taxibe;

CREATE OR REPLACE TABLE vehicules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero_immatriculation VARCHAR(20) NOT NULL
);

CREATE OR REPLACE TABLE chauffeurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL
);

CREATE OR REPLACE voiture_actif (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idChauffeur INT,
    idVehicule INT,
    date DATE NOT NULL,
    FOREIGN KEY (idChauffeur) REFERENCES chauffeurs(id),
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id)
);

CREATE OR REPLACE type_trajet (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(100) NOT NULL
);

CREATE OR REPLACE TABLE course (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idChauffeur INT,
    idVehicule INT,
    pointDepart VARCHAR(100) NOT NULL,
    pointArrivee VARCHAR(100) NOT NULL,
    dateDebut DATETIME NOT NULL,
    dateFin DATETIME NOT NULL,
    montant_recette DECIMAL(10, 2) NOT NULL,
    montant_carburant DECIMAL(10, 2) NOT NULL,
    distance_km DECIMAL(10, 2) NOT NULL,
    idTypeTrajet INT,
    FOREIGN KEY (idChauffeur) REFERENCES chauffeurs(id),
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id),
    FOREIGN KEY (idTypeTrajet) REFERENCES type_trajet(id
);

CREATE TABLE vehicule_panne (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVehicule INT,
    dateDebut DATE NOT NULL,
    dateFin DATE
);

-- ...existing code...
INSERT INTO vehicule_panne (idVehicule, dateDebut, dateFin) VALUES
(1, '2025-12-10', '2025-12-10'),
(2, '2025-12-11', '2025-12-13'),
(3, '2025-12-14', NULL),
(4, '2025-12-05', '2025-12-06');
COMMIT;
-- ...existing code...

CREATE TABLE versement_minimum (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVehicule INT,
    montant DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id)
);

CREATE TABLE versement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVehicule INT,
    idChauffeur INT,
    montant DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id),
    FOREIGN KEY (idChauffeur) REFERENCES chauffeurs(id)
);

CREATE TABLE config_versement (
    int INT PRIMARY KEY AUTO_INCREMENT,
    pourcentage DECIMAL(5, 2) NOT NULL,
    etat VARCHAR(50) NOT NULL
);

INSERT INTO config_versement (pourcentage, etat) VALUES
(8.00,  'INFERIEUR'),
(25.00, 'SUPERIEUR');


CREATE OR REPLACE VIEW v_versement_journalier AS
SELECT
    v.id,
    v.date,
    v.idChauffeur,
    c.nom AS chauffeur,
    v.idVehicule,
    ve.numero_immatriculation,
    v.montant AS versement_jour,
    vm.montant AS versement_minimum
FROM versement v
JOIN chauffeurs c ON c.id = v.idChauffeur
JOIN vehicules ve ON ve.id = v.idVehicule
JOIN versement_minimum vm ON vm.idVehicule = ve.id;

CREATE OR REPLACE VIEW v_versement_avec_pourcentage AS
SELECT
    vj.*,
    cfg.pourcentage
FROM v_versement_journalier vj
JOIN config_versement cfg
    ON cfg.etat = CASE
        WHEN vj.versement_jour < vj.versement_minimum
            THEN 'INFERIEUR'
        ELSE 'SUPERIEUR'
    END;

CREATE OR REPLACE VIEW v_salaire_chauffeur_par_date AS
SELECT
    date,
    idChauffeur,
    chauffeur,
    idVehicule,
    numero_immatriculation,
    versement_jour,
    versement_minimum,
    pourcentage,
    (versement_jour * pourcentage / 100) AS salaire
FROM v_versement_avec_pourcentage;


