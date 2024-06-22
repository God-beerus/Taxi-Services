<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $immatriculation = $_POST['immatriculation'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];

    $sql = "INSERT INTO voitures (immatriculation, marque, modele) VALUES ('$immatriculation', '$marque', '$modele')";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Nouvelle voiture ajoutée avec succès
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
    } else {
        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Erreur :</strong> ' . $sql . '<br>' . $conn->error . '
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Voiture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Ajouter une nouvelle voiture</h1>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="immatriculation">Immatriculation :</label>
                <input type="text" id="immatriculation" name="immatriculation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="marque">Marque :</label>
                <input type="text" id="marque" name="marque" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle :</label>
                <input type="text" id="modele" name="modele" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
