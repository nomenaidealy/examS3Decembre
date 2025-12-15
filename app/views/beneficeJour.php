<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Total montant bénéfice par jour</h1>
    <table border = "1">
        <tr>
            <th>date_jour</th>
            <th>benefice_total_jour</th>
        </tr>
        <tr>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['date_jour']); ?></td>
                    <td><?php echo htmlspecialchars($row['benefice_total_jour']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tr>

    </table>
</body>
</html>