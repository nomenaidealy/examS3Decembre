<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion Véhicules</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/assets/acceuil.css">
</head>
<body>

<!-- HEADER -->
<?php include 'header.php'; ?>
<!-- CONTENU -->
<div class="container-main">
    <h1 class="page-title">
        <i class="fas fa-list-alt"></i>
        Liste par jour des véhicules et son chauffeur correspondant
    </h1>
    
    <div class="table-card">
        <div class="table-card-header">
            <h2>
                <i class="fas fa-table"></i>
                Journal de bord des véhicules
            </h2>
            <div class="table-info">
                <i class="fas fa-info-circle"></i>
                <?php echo count($data); ?> enregistrements
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Date du jour</th>
                        <th>Véhicule</th>
                        <th>Chauffeur</th>
                        <th>Km effectués</th>
                        <th>Recette</th>
                        <th>Carburant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td data-label="Date du jour">
                            <span class="data-badge">
                                <i class="far fa-calendar"></i>
                                <?php echo htmlspecialchars($row['date_jour']); ?>
                            </span>
                        </td>
                        <td data-label="Véhicule">
                            <i class="fas fa-car"></i>
                            <?php echo htmlspecialchars($row['vehicule']); ?>
                        </td>
                        <td data-label="Chauffeur">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($row['chauffeur']); ?>
                        </td>
                        <td data-label="Km effectués">
                            <span class="data-badge" style="background-color: rgba(61, 155, 125, 0.1); color: var(--secondary-color);">
                                <i class="fas fa-tachometer-alt"></i>
                                <?php echo htmlspecialchars($row['km_effectues']); ?> km
                            </span>
                        </td>
                        <td data-label="Recette">
                            <span class="data-badge" style="background-color: rgba(40, 199, 111, 0.1); color: var(--success-color);">
                                <i class="fas fa-euro-sign"></i>
                                <?php echo htmlspecialchars($row['recette']); ?> €
                            </span>
                        </td>
                        <td data-label="Carburant">
                            <span class="data-badge" style="background-color: rgba(255, 159, 67, 0.1); color: var(--warning-color);">
                                <i class="fas fa-gas-pump"></i>
                                <?php echo htmlspecialchars($row['carburant']); ?> L
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>