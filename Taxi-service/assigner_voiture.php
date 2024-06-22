<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_chauffeur = $_POST['id_chauffeur'];
    $id_voiture = $_POST['id_voiture'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    $sql = "INSERT INTO assignations (id_chauffeur, id_voiture, date_debut, date_fin) VALUES ('$id_chauffeur', '$id_voiture', '$date_debut', '$date_fin')";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert alert-success">Voiture assignée avec succès</div>';
    } else {
        $message = '<div class="alert alert-danger">Erreur : ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

// Récupérer les chauffeurs
$sql_chauffeurs = "SELECT id, nom, prenom FROM chauffeurs";
$result_chauffeurs = $conn->query($sql_chauffeurs);

// Récupérer les voitures
$sql_voitures = "SELECT id, immatriculation FROM voitures";
$result_voitures = $conn->query($sql_voitures);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Assigner Voiture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #337ab7;
        }
        label {
            font-weight: bold;
        }
        input[type="date"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #337ab7;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #286090;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assigner une voiture à un chauffeur</h1>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_chauffeur">Chauffeur :</label>
                <select id="id_chauffeur" name="id_chauffeur" class="form-control" required>
                    <?php
                    if ($result_chauffeurs->num_rows > 0) {
                        while($row = $result_chauffeurs->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Aucun chauffeur disponible</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_voiture">Voiture :</label>
                <select id="id_voiture" name="id_voiture" class="form-control" required>
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
                <label for="date_debut">Date de début :</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_fin">Date de fin :</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Assigner</button>
        </form>
    </div>
</body>
</html>
