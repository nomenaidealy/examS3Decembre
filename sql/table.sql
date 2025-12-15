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