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