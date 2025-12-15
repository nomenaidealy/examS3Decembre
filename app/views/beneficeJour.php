<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bénéfice par Jour</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/assets/beneficeJour.css">

</head>
<body>
<h1>Total montant bénéfice par jour</h1>

<div class="container-main">
  <table>
    <thead>
      <tr>
        <th>date_jour</th>
        <th>benefice_total_jour</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['date_jour']); ?></td>
        <td><?php echo htmlspecialchars($row['benefice_total']); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>