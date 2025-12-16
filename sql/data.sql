-- Créer la base de données
CREATE DATABASE IF NOT EXISTS taxibe;
USE taxibe;

-- Table des véhicules
CREATE TABLE IF NOT EXISTS vehicules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero_immatriculation VARCHAR(20) NOT NULL
);

-- Table des chauffeurs
CREATE TABLE IF NOT EXISTS chauffeurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL
);

-- Table pour savoir quel chauffeur conduit quel véhicule chaque jour
CREATE TABLE IF NOT EXISTS voiture_actif (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idChauffeur INT NOT NULL,
    idVehicule INT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (idChauffeur) REFERENCES chauffeurs(id),
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id)
);

-- Table des types de trajet (aller, retour, etc.)
CREATE TABLE IF NOT EXISTS type_trajet (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(100) NOT NULL
);

-- Table des courses / trajets
CREATE TABLE IF NOT EXISTS course (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idChauffeur INT NOT NULL,
    idVehicule INT NOT NULL,
    pointDepart VARCHAR(100) NOT NULL,
    pointArrivee VARCHAR(100) NOT NULL,
    dateDebut DATETIME NOT NULL,
    dateFin DATETIME NOT NULL,
    montant_recette DECIMAL(10,2) NOT NULL,
    montant_carburant DECIMAL(10,2) NOT NULL,
    distance_km DECIMAL(10,2) NOT NULL,
    idTypeTrajet INT NOT NULL,
    FOREIGN KEY (idChauffeur) REFERENCES chauffeurs(id),
    FOREIGN KEY (idVehicule) REFERENCES vehicules(id),
    FOREIGN KEY (idTypeTrajet) REFERENCES type_trajet(id)
);

CREATE TABLE vehicule_panne (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVehicule INT,
    dateDebut DATE NOT NULL,
    dateFin DATE
);


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
    id INT PRIMARY KEY AUTO_INCREMENT,
    pourcentage DECIMAL(5, 2) NOT NULL,
    etat VARCHAR(50) NOT NULL
);



INSERT INTO chauffeurs (nom) VALUES
('Rabe'),
('Ando'),
('Hery'),
('Lala');

INSERT INTO vehicules (numero_immatriculation) VALUES
('ABC-123'),
('DEF-456'),
('GHI-789'),
('JKL-012');


INSERT INTO type_trajet (description) VALUES
('Aller'),
('Retour');


INSERT INTO voiture_actif (idChauffeur, idVehicule, date) VALUES
(1, 1, '2025-12-12'),
(2, 2, '2025-12-12'),
(3, 3, '2025-12-12'),
(4, 4, '2025-12-12'),
(1, 2, '2025-12-13'),
(2, 3, '2025-12-13');


INSERT INTO course (idChauffeur, idVehicule, pointDepart, pointArrivee, dateDebut, dateFin, montant_recette, montant_carburant, distance_km, idTypeTrajet) VALUES
(1, 1, 'Andoharanofotsy', 'Ambohibao', '2025-12-12 08:00:00', '2025-12-12 08:30:00', 5000, 1000, 10, 1),
(1, 1, 'Ambohibao', 'Andoharanofotsy', '2025-12-12 17:00:00', '2025-12-12 17:30:00', 5000, 1000, 10, 2),
(2, 2, 'Analakely', 'Ankorondrano', '2025-12-12 09:00:00', '2025-12-12 09:45:00', 7000, 1500, 15, 1),
(2, 2, 'Ankorondrano', 'Analakely', '2025-12-12 18:00:00', '2025-12-12 18:45:00', 7000, 1500, 15, 2),
(3, 3, 'Ivandry', 'Ambohijatovo', '2025-12-12 10:00:00', '2025-12-12 10:30:00', 4000, 800, 8, 1),
(3, 3, 'Ambohijatovo', 'Ivandry', '2025-12-12 19:00:00', '2025-12-12 19:30:00', 4000, 800, 8, 2),
(4, 4, 'Ankatso', 'Tsaralalàna', '2025-12-12 11:00:00', '2025-12-12 11:30:00', 6000, 1200, 12, 1),
(4, 4, 'Tsaralalàna', 'Ankatso', '2025-12-12 20:00:00', '2025-12-12 20:30:00', 6000, 1200, 12, 2);
COMMIT;


CREATE OR REPLACE VIEW vueListeChauffeurVehicule AS
SELECT
    va.date AS date_jour,
    v.numero_immatriculation AS vehicule,
    c.nom AS chauffeur,
    COALESCE(SUM(co.distance_km), 0) AS km_effectues,
    COALESCE(SUM(co.montant_recette), 0) AS recette,
    COALESCE(SUM(co.montant_carburant), 0) AS carburant
FROM voiture_actif va
JOIN chauffeurs c ON va.idChauffeur = c.id
JOIN vehicules v ON va.idVehicule = v.id
LEFT JOIN course co
    ON co.idChauffeur = va.idChauffeur
    AND co.idVehicule = va.idVehicule
    AND DATE(co.dateDebut) = va.date
GROUP BY va.date, v.numero_immatriculation, c.nom
ORDER BY va.date, v.numero_immatriculation;

CREATE OR REPLACE VIEW vue_benefice_vehicule AS
SELECT
    v.numero_immatriculation AS vehicule,
    DATE(c.dateDebut) AS date_jour,
    COALESCE(SUM(c.montant_recette - c.montant_carburant), 0) AS benefice
FROM vehicules v
LEFT JOIN course c ON c.idVehicule = v.id
GROUP BY v.numero_immatriculation, DATE(c.dateDebut)
ORDER BY DATE(c.dateDebut), v.numero_immatriculation;


CREATE OR REPLACE VIEW vue_benefice_par_jour AS
SELECT
    DATE(c.dateDebut) AS date_jour,
    COALESCE(SUM(c.montant_recette - c.montant_carburant), 0) AS benefice_total
FROM course c
GROUP BY DATE(c.dateDebut)
ORDER BY DATE(c.dateDebut);



CREATE OR REPLACE VIEW vue_trajets_rentables AS
SELECT sub.date_jour, sub.pointDepart, sub.pointArrivee, sub.benefice
FROM (
    SELECT 
        DATE(c.dateDebut) AS date_jour,
        c.pointDepart,
        c.pointArrivee,
        (c.montant_recette - c.montant_carburant) AS benefice,
        RANK() OVER (
            PARTITION BY DATE(c.dateDebut) 
            ORDER BY (c.montant_recette - c.montant_carburant) DESC
        ) AS rang
    FROM course c
) sub
WHERE sub.rang = 1
ORDER BY sub.date_jour;
COMMIT;

-- ...existing code...
INSERT INTO vehicule_panne (idVehicule, dateDebut, dateFin) VALUES
(1, '2025-12-10', '2025-12-10'),
(2, '2025-12-11', '2025-12-13'),
(3, '2025-12-14', NULL),
(4, '2025-12-05', '2025-12-06');
COMMIT;
-- ...existing code...

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

