<?php
function analyserRecettes($periode) {
    global $conn;
    if ($periode == 'semaine') {
        $sql = "SELECT id_chauffeur, SUM(montant) as total_montant 
                FROM recettes 
                WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) 
                GROUP BY id_chauffeur";
    } elseif ($periode == 'mois') {
        $sql = "SELECT id_chauffeur, SUM(montant) as total_montant 
                FROM recettes 
                WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
                GROUP BY id_chauffeur";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Chauffeur ID: " . $row["id_chauffeur"]. " - Total Montant: " . $row["total_montant"]. "<br>";
        }
    } else {
        echo "0 résultats";
    }
}
?>
