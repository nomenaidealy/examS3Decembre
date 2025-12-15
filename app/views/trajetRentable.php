<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trajets Rentables</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/assets/trajetRentable.css">
</head>

<body>
  <?php include 'header.php'; ?>
<h1>Les trajets les plus rentables par jour</h1>

<div class="container-main">
  <table>
    <thead>
      <tr>
        <th>date_jour</th>
        <th>pointDepart</th>
        <th>pointArrivee</th>
        <th>benefice</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['date_jour']); ?></td>
        <td><?php echo htmlspecialchars($row['pointDepart']); ?></td>
        <td><?php echo htmlspecialchars($row['pointArrivee']); ?></td>
        <td><?php echo htmlspecialchars($row['benefice']); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
   <a href="/">retour</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>