<?php
include '../assets/menu.php'; // Inclure le menu
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générer un rapport</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF5E1; 
            color: #6E4B3A; 
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #FFFFFF; 
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #6E4B3A; 
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form div {
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }

        input[type="date"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #CCC;
            border-radius: 4px;
            font-size: 1rem;
            color: #6E4B3A;
        }

        button {
            background-color: #6E4B3A;
            color: #FFF;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #F39C12;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Générer un rapport</h2>
        <form action="generate_report.php" method="GET">
            <div>
                <label for="start_date">Date de début :</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div>
                <label for="end_date">Date de fin :</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit">Générer le rapport</button>
        </form>
    </div>
    <?php include '../assets/footer.php'; ?>
</body>
</html>
