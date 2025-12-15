<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bénéfice Véhicule</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/assets/benefice.css">
</head>
<body>
<h1>Total montant bénéfice par véhicule</h1>

<div class="container-main">
  <table>
    <thead>
      <tr>
        <th>vehicule</th>
        <th>Date</th>
        <th>benefice_total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['vehicule']); ?></td>
        <td><?php echo htmlspecialchars($row['date_jour']); ?></td>
        <td><?php echo htmlspecialchars($row['benefice']); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="/">retour</a>
</div>
</body>
</html>