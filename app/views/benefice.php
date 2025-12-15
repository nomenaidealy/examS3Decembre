<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Total montant bénéfice par véhicule</h1>
    <table border = "1">
        <tr>
            <th>vehicule</th>
            <th>Date</th>
            <th>benefice_total</th>
        </tr>
        <tr>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['vehicule']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['benefice_total']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tr>

    </table>
</body>
</html>