<?php
function assignerVoiture($id_chauffeur, $id_voiture, $date_debut, $date_fin) {
    global $conn;
    $sql = "INSERT INTO assignations (id_chauffeur, id_voiture, date_debut, date_fin) VALUES ('$id_chauffeur', '$id_voiture', '$date_debut', '$date_fin')";
    if ($conn->query($sql) === TRUE) {
        echo "Voiture assignée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>
