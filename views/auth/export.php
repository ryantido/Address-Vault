<?php
   
    $pageTitle = "Exportation de contacts - AddressVault";
    ob_start();

    $contacts = [
        ['id' => 1, 'nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'telephone' => '0102030405', 'categorie' => 'client'],
        ['id' => 2, 'nom' => 'Martin', 'prenom' => 'Sophie', 'email' => 'sophie.martin@example.com', 'telephone' => '0607080910', 'categorie' => 'fournisseur'],
        ['id' => 3, 'nom' => 'Durand', 'prenom' => 'Paul', 'email' => 'paul.durand@example.com', 'telephone' => '0203040506', 'categorie' => 'client'],
    ];

    $exportLink = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $selectedIds = isset($_POST['ids']) ? array_map('intval', $_POST['ids']) : [];
        $format = $_POST['format'] ?? 'csv';

        
        $selectedContacts = array_filter($contacts, function($contact) use ($selectedIds) {
            return in_array($contact['id'], $selectedIds);
        });

        
        if (empty($selectedContacts)) {
            echo "<div class='card'><h2>Erreur</h2><p>Aucun contact sélectionné pour l'export.</p></div>";
        } else {
            
            $exportFolder = __DIR__ . '/../../exports/';
            if (!is_dir($exportFolder)) {
                mkdir($exportFolder, 0755, true);
            }

            
            $filename = 'contacts_' . time();
            $filepath = '';
            
            if ($format === 'csv') {
                $filename .= '.csv';
                $filepath = $exportFolder . $filename;
                $fp = fopen($filepath, 'w');
                
                fputcsv($fp, ['Nom', 'Prénom', 'Email', 'Téléphone', 'Catégorie']);
                
                foreach ($selectedContacts as $contact) {
                    fputcsv($fp, [
                        $contact['nom'],
                        $contact['prenom'],
                        $contact['email'],
                        $contact['telephone'],
                        $contact['categorie']
                    ]);
                }
                fclose($fp);
            } elseif ($format === 'pdf') {
                $filename .= '.pdf';
                $filepath = $exportFolder . $filename;
                require_once(__DIR__ . '/../../fpdf/fpdf.php'); 
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',12);
                // En-tête du PDF
                $pdf->Cell(40, 10, 'Nom', 1);
                $pdf->Cell(40, 10, 'Prénom', 1);
                $pdf->Cell(60, 10, 'Email', 1);
                $pdf->Cell(30, 10, 'Téléphone', 1);
                $pdf->Cell(30, 10, 'Catégorie', 1);
                $pdf->Ln();
                $pdf->SetFont('Arial','',12);
                foreach ($selectedContacts as $contact) {
                    $pdf->Cell(40, 10, $contact['nom'], 1);
                    $pdf->Cell(40, 10, $contact['prenom'], 1);
                    $pdf->Cell(60, 10, $contact['email'], 1);
                    $pdf->Cell(30, 10, $contact['telephone'], 1);
                    $pdf->Cell(30, 10, $contact['categorie'], 1);
                    $pdf->Ln();
                }
                $pdf->Output('F', $filepath);
            }

            $exportLink = 'http://' . $_SERVER['HTTP_HOST'] . '/exports/' . $filename;
            
            echo "<div class='card'>";
            echo "<h2>Export réussi !</h2>";
            echo "<p>Format sélectionné : " . htmlspecialchars($format) . "</p>";
            echo "<p><strong>Lien de téléchargement :</strong></p><br>";
            echo "<p><a href='" . htmlspecialchars($exportLink) . "' target='_blank' class='submit-btn'>" . htmlspecialchars($exportLink) . "</a></p>";
            echo "</div>";
        }
    }

?>

    <div class="container export-section">
    <div class="card">
        <h2>Exporter vos contacts</h2>
        <form method="POST" action="">
        <div class="form-section">
            <p>Sélectionnez les contacts à exporter :</p>
            <?php foreach ($contacts as $contact): ?>
            <label>
                <input type="checkbox" name="ids[]" value="<?= htmlspecialchars($contact['id']) ?>">
                <?= htmlspecialchars($contact['nom']) ?> <?= htmlspecialchars($contact['prenom']) ?>
            </label>
            <br>
            <?php endforeach; ?>
        </div>
        <div class="form-section">
            <label for="format" class="form-label">Format d'export :</label>
            <select name="format" id="format">
            <option value="csv">CSV</option>
            <option value="pdf">PDF</option>
            </select>
        </div>
        <div class="form-section center">
            <button type="submit" class="submit-btn">Exporter</button>
        </div>
        </form>
    </div>
    <?php if (!empty($exportLink)): ?>
    <div class="card" style="margin-top: 1rem;">
        <h2>Export Disponible</h2>
        <p>Téléchargez vos contacts exportés :</p><br>
        <p><a href="<?= htmlspecialchars($exportLink) ?>" class="submit-btn" target="_blank"><?= htmlspecialchars($exportLink) ?></a></p>
    </div>
    <?php endif; ?>
    </div>

<?php
$content = ob_get_clean();
include 'views/template/template.view.php';
?>
