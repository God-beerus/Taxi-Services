<?php
function ajouterVoiture($immatriculation, $marque, $modele) {
    global $conn;
    $sql = "INSERT INTO voitures (immatriculation, marque, modele) VALUES ('$immatriculation', '$marque', '$modele')";
    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle voiture ajoutée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>
