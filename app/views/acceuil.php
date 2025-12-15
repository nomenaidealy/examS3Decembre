<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion Véhicules</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/acceuil.css">
</head>
<body>
<div class="container-main">
  <h1>Liste par jour des véhicules et son chauffeur correspondant</h1>
  
  <table border ="1">
    <thead>
      <tr>
        <th>date_jour</th>
        <th>vehicule</th>
        <th>chauffeur</th>
        <th>km_effectues</th>
        <th>recette</th>
        <th>carburant</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['date_jour']); ?></td>
        <td><?php echo htmlspecialchars($row['vehicule']); ?></td>
        <td><?php echo htmlspecialchars($row['chauffeur']); ?></td>
        <td><?php echo htmlspecialchars($row['km_effectues']); ?></td>
        <td><?php echo htmlspecialchars($row['recette']); ?></td>
        <td><?php echo htmlspecialchars($row['carburant']); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
  <div class="links-section">
    <a href="benefice/vehicule">voir Total montant bénéfice par véhicule</a>
    <a href="benefice/jour">voir Total montant bénéfice par jour</a>
    <a href="trajet/rentable">voir les trajets les plus rentables par jour</a>
  </div>
</div>
</body>
</html>