<?php
function ajouterChauffeur($nom, $prenom, $telephone) {
    global $conn;
    $sql = "INSERT INTO chauffeurs (nom, prenom, telephone) VALUES ('$nom', '$prenom', '$telephone')";
    if ($conn->query($sql) === TRUE) {
        echo "Nouveau chauffeur ajouté avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>
