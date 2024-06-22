<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

function analyserRecettes($periode) {
    global $conn;

    // Validation de la période
    if ($periode == 'semaine') {
        $interval = '1 WEEK';
    } elseif ($periode == 'mois') {
        $interval = '1 MONTH';
    } else {
        echo "Période invalide.";
        return;
    }

    // Préparer la requête pour éviter les injections SQL
    $periode = $conn->real_escape_string($periode);

    // Calcul des recettes
    $sql = "SELECT c.id AS id_chauffeur, c.nom, c.prenom, SUM(r.montant) AS total_recettes 
            FROM recettes r
            JOIN chauffeurs c ON r.id_chauffeur = c.id
            WHERE r.date >= DATE_SUB(CURDATE(), INTERVAL $interval)
            GROUP BY c.id, c.nom, c.prenom";
    $result = $conn->query($sql);

    // Vérifier s'il y a des résultats
    if ($result === false) {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
        return;
    }

    // Affichage des résultats
    if ($result->num_rows > 0) {
        echo '<div class="container">';
        echo '<h2>Rapport d\'analyse des recettes</h2>';

        echo '<table>';
        echo '<tr><th>Chauffeur</th><th>Total Recettes</th><th>Salaire</th><th>Coût de Maintenance</th><th>Bénéfice Brut</th></tr>';

        while ($row = $result->fetch_assoc()) {
            $id_chauffeur = $row['id_chauffeur'];
            $nom_chauffeur = htmlspecialchars($row['nom'] . ' ' . $row['prenom']);
            $total_recettes = $row['total_recettes'];
            $salaire = $total_recettes * 0.25;

            // Calcul des coûts de maintenance
            $sql_maintenance = "SELECT SUM(montant) as total_maintenance 
                                FROM maintenance 
                                WHERE id_voiture IN (SELECT id_voiture 
                                                     FROM assignations 
                                                     WHERE id_chauffeur = $id_chauffeur 
                                                     AND date_debut <= CURDATE() 
                                                     AND (date_fin >= CURDATE() OR date_fin IS NULL)) 
                                AND date >= DATE_SUB(CURDATE(), INTERVAL $interval)";
            $result_maintenance = $conn->query($sql_maintenance);

            // Vérifier s'il y a des résultats pour la maintenance
            if ($result_maintenance === false) {
                echo "Erreur lors de l'exécution de la requête de maintenance : " . $conn->error;
                continue; // Passer au prochain chauffeur
            }

            $total_maintenance = 0;
            if ($result_maintenance->num_rows > 0) {
                $row_maintenance = $result_maintenance->fetch_assoc();
                $total_maintenance = $row_maintenance['total_maintenance'];
            }

            // Calcul du bénéfice brut
            $benefice_brut = $total_recettes - $total_maintenance;

            // Affichage des résultats dans le tableau
            echo '<tr>';
            echo '<td>' . $nom_chauffeur . '</td>';
            echo '<td>' . $total_recettes . '</td>';
            echo '<td>' . $salaire . '</td>';
            echo '<td>' . $total_maintenance . '</td>';
            echo '<td>' . $benefice_brut . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo "Aucun résultat trouvé pour la période spécifiée.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Analyser Recettes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Analyser les recettes</h1>
        <form method="GET" action="">
            <label for="periode">Période:</label>
            <select id="periode" name="periode">
                <option value="semaine">Semaine</option>
                <option value="mois">Mois</option>
            </select>
            <input type="submit" value="Analyser">
        </form>
    </div>

    <?php
    // Vérifier si la période est définie et appeler la fonction analyserRecettes
    if (isset($_GET['periode'])) {
        analyserRecettes($_GET['periode']);
    }
    ?>

</body>
</html>

<?php
// Fermeture de la connexion à la base de données à la fin du script
$conn->close();
?>
