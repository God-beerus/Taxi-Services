<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_voiture = $_POST['id_voiture'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];

    $sql = "INSERT INTO maintenance (id_voiture, montant, date) VALUES ('$id_voiture', '$montant', '$date')";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Maintenance ajoutée avec succès
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

// Récupérer les voitures
$sql_voitures = "SELECT id, immatriculation FROM voitures";
$result_voitures = $conn->query($sql_voitures);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Maintenance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Ajouter un nouveau coût de maintenance</h1>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_voiture">Voiture :</label>
                <select id="id_voiture" name="id_voiture" class="form-control">
                    <?php
                    if ($result_voitures->num_rows > 0) {
                        while($row = $result_voitures->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['immatriculation'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Aucune voiture disponible</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="montant">Montant :</label>
                <input type="text" id="montant" name="montant" class="form-control">
            </div>
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
