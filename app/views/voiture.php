<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules disponibles</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 1rem; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        .info { margin-top: .5rem; color: #333; }
    </style>
</head>
<body>
    <h1>Recherche de véhicules disponibles</h1>

    <form method="post" action="/voitureDispo/search">
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required value="<?php echo isset($searchDate) ? htmlspecialchars($searchDate) : ''; ?>">
        <button type="submit">Rechercher</button>
    </form>

    <?php if (isset($searchDate) && $searchDate): ?>
        <p class="info">Résultats pour : <strong><?php echo htmlspecialchars($searchDate); ?></strong></p>
    <?php endif; ?>

    <?php if (empty($data)): ?>
        <p class="info">Aucun véhicule trouvé.</p>
    <?php else: ?>
        <table aria-live="polite">
            <thead>
                <tr>
                    <?php
                    // Générer les en-têtes à partir des clés du premier élément
                    $first = reset($data);
                    foreach ($first as $k => $v): ?>
                        <th><?php echo htmlspecialchars($k); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($first as $k => $_): ?>
                            <td><?php echo isset($row[$k]) ? htmlspecialchars((string)$row[$k]) : ''; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>