<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border = "1">
        <tr>
            <th>date_jour</th>
            <th>vehicule</th>
            <th>chauffeur</th>
            <th>km_effectues</th>
            <th>recette</th>
            <th>carburant</th>
        </tr>
        <tr>
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
        </tr>

    </table>
</body>
</html>