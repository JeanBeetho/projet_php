<?php
// Inclure FPDF et configuration
require_once('../libs/fpdf186/fpdf.php');
require_once('../config/config.php');

// Vérifier si les paramètres GET sont fournis
if (!isset($_GET['start_date'], $_GET['end_date'])) {
    $error_message = "Les dates de début et de fin sont requises.";
    echo $error_message;
    exit();
}

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// Vérifier que la date de début n'est pas supérieure à la date de fin
if (strtotime($start_date) > strtotime($end_date)) {
    $error_message = "La date de début ne peut pas être supérieure à la date de fin.";
    echo $error_message;
    exit();
}

try {
    // Requête pour récupérer les ventes entre les dates, y compris la date de vente
    $stmt = $pdo->prepare("
        SELECT 
            clients.nom AS client_nom,
            plats.nom AS plat_nom,
            plats.cuisson AS type_cuisson,
            plats.prix,
            ventes.nombre_plats AS quantite,
            (plats.prix * ventes.nombre_plats) AS total,
            DATE(ventes.date_vente) AS date_vente
        FROM ventes
        JOIN clients ON ventes.client_id = clients.id
        JOIN plats ON ventes.plat_id = plats.id
        WHERE ventes.date_vente BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des ventes ont été trouvées
    if (empty($results)) {
        $error_message = "Aucune vente n'a été enregistrée dans cette période.";
        echo $error_message;
        exit();
    }
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des données : " . $e->getMessage();
    echo $error_message;
    exit();
}

// Calculer la somme des prix et la somme des quantités vendues
$total_price = 0;
$total_quantity = 0;
foreach ($results as $row) {
    $total_price += $row['prix'] * $row['quantite'];
    $total_quantity += $row['quantite'];
}

// Créer le PDF
class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        $this->Image('../assets/images/logo_cafe_.jpg', 10, 6, 30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Campus Henry Christophe de Limonade', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, 'Rapport des ventes de la cafeteria', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Periode : ' . $_GET['start_date'] . ' a ' . $_GET['end_date'], 0, 1, 'C');
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Cafeteria du Campus Henry Christophe de Limonade - Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Tableau des données avec les sommes
    function Table($header, $data, $total_price, $total_quantity)
    {
        // Couleur de fond pour les en-têtes
        $this->SetFillColor(200, 220, 255);
        // Police pour les en-têtes
        $this->SetFont('Arial', 'B', 10);

        // Largeurs des colonnes (ajustées pour permettre la visibilité de la date)
        $widths = [30, 30, 30, 25, 25, 25, 30];  // Colonnes réduites

        // Affichage des en-têtes
        foreach ($header as $i => $col) {
            $this->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
        }
        $this->Ln();

        // Police pour les données
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $index => $col) {
                // Formater les prix et totaux
                if ($index == 3 || $index == 5) {
                    $col = number_format($col, 2, '.', '') . ' $';
                }
                $this->Cell($widths[$index], 10, $col, 1, 0, 'C');
            }
            $this->Ln();
        }

        // Afficher la somme des prix et des plats
        $this->Ln(5);  // Saut de ligne
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(160, 10, 'Total des ventes : ' . number_format($total_price, 2, '.', '') . ' $', 1, 0, 'R');
        $this->Cell(40, 10, 'Total des plats : ' . $total_quantity, 1, 1, 'C');
    }
}

// Créer un objet PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// En-têtes du tableau, ajout de la colonne "Date de vente"
$header = ['Nom Client', 'Plat', 'Type Cuisson', 'Prix', 'Quantite', 'Total', 'Date de Vente'];

// Préparer les données pour le tableau
$data = [];
foreach ($results as $row) {
    $data[] = [
        $row['client_nom'],
        $row['plat_nom'],
        $row['type_cuisson'],
        number_format($row['prix'], 2, '.', ''),
        $row['quantite'],
        number_format($row['total'], 2, '.', ''),
        $row['date_vente']
    ];
}

// Ajouter le tableau et les totaux
$pdf->Table($header, $data, $total_price, $total_quantity);

// Afficher le PDF
$pdf->Output('I', 'rapport_ventes.pdf');
?>
