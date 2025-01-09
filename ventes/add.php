<?php
require '../config/config.php';
include '../assets/menu.php'; // Inclure le menu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $client_id = $_POST['client_id'];
    $plat_id = $_POST['plat_id'];
    $nombre_plats = 1; // Forcé à 1 par défaut
    $date_vente = date('Y-m-d'); // Obtenir la date du jour

    //  Vérifier si le client a déjà effectué un achat aujourd'hui
    $checkClientQuery = $pdo->prepare("SELECT COUNT(*) FROM ventes WHERE client_id = ? AND date_vente = ?");
    $checkClientQuery->execute([$client_id, $date_vente]);
    $hasBoughtToday = $checkClientQuery->fetchColumn();

    if ($hasBoughtToday > 0) {
        // Message d'erreur si le client a déjà acheté aujourd'hui
        $error = "Ce client a déjà effectué un achat aujourd'hui. Vous ne pouvez pas effectuer une nouvelle vente.";
    } else {
        //  Vérifier si le plat est disponible aujourd'hui et en quantité suffisante
        $checkPlatQuery = $pdo->prepare("SELECT quantite FROM plats WHERE id = ? AND DATE(date_ajout) = ?");
        $checkPlatQuery->execute([$plat_id, $date_vente]);
        $plat = $checkPlatQuery->fetch(PDO::FETCH_ASSOC);

        if (!$plat) {
            // Le plat n'a pas été enregistré aujourd'hui
            $error = "Ce plat n'est pas enregistré pour aujourd'hui.";
        } elseif ($plat['quantite'] < $nombre_plats) {
            // La quantité demandée est supérieure à la quantité disponible
            $error = "La quantité demandée dépasse la quantité disponible.";
        } else {
            //  Enregistrer la vente et décrémenter la quantité du plat
            $pdo->beginTransaction();

            try {
                // Insérer la vente
                $insertQuery = $pdo->prepare(
                    "INSERT INTO ventes (client_id, plat_id, nombre_plats, date_vente) VALUES (?, ?, ?, ?)"
                );
                $insertQuery->execute([$client_id, $plat_id, $nombre_plats, $date_vente]);

                // Mettre à jour la quantité disponible du plat
                $updatePlatQuery = $pdo->prepare(
                    "UPDATE plats SET quantite = quantite - ? WHERE id = ?"
                );
                $updatePlatQuery->execute([$nombre_plats, $plat_id]);

                // Valider la transaction
                $pdo->commit();

                // Redirection après ajout
                header("Location: index.php");
                exit;
            } catch (Exception $e) {
                // Annuler la transaction en cas d'erreur
                $pdo->rollBack();
                $error = "Une erreur est survenue lors de l'enregistrement de la vente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une vente</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="add-container">
        <div class="add-box">
            <h2>Ajouter une vente</h2>
            <?php if (!empty($error)): ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="client_id">Code client :</label>
                    <select id="client_id" name="client_id" required>
                        <?php
                        $clientsQuery = $pdo->query("SELECT id, nom FROM clients");
                        $clients = $clientsQuery->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($clients as $client) {
                            echo "<option value='" . htmlspecialchars($client['id']) . "'>" . htmlspecialchars($client['nom']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="plat_id">Code plat :</label>
                    <select id="plat_id" name="plat_id" required>
                        <?php
                        $platsQuery = $pdo->query("SELECT id, nom FROM plats");
                        $plats = $platsQuery->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($plats as $plat) {
                            echo "<option value='" . htmlspecialchars($plat['id']) . "'>" . htmlspecialchars($plat['nom']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre_plats">Nombre de plats :</label>
                    <input type="number" id="nombre_plats" name="nombre_plats" value="1" readonly>
                </div>
                <button type="submit">Ajouter la vente</button>
            </form>
            <a href="index.php" class="back-link">Retour à la liste des ventes</a>
        </div>
    </div>
    <?php include '../assets/footer.php'; ?>
</body>
</html>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background: #F9E79F; 
        color: #6E4B3A;
        display: block;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .error { color: red; }

    .add-container {
        width: 600px;
        padding: 30px;
        margin-left: 400px;
        margin-top: 10px;
        background-color: #FFF5E1;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .add-box h2 {
        margin-bottom: 20px;
        color: #6E4B3A;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #6E4B3A;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #FFCC00;
        outline: none;
    }

    button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFCC00;
        color: #6E4B3A;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #F39C12;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #6E4B3A;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>
