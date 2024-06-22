<?php
function enregistrerRecette($id_chauffeur, $id_voiture, $montant, $date) {
    global $conn;
    $sql = "INSERT INTO recettes (id_chauffeur, id_voiture, montant, date) VALUES ('$id_chauffeur', '$id_voiture', '$montant', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Recette enregistrée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>
