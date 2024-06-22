<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_chauffeur = $_POST['id_chauffeur'];
    $id_voiture = $_POST['id_voiture'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];

    $sql = "INSERT INTO recettes (id_chauffeur, id_voiture, montant, date) VALUES ('$id_chauffeur', '$id_voiture', '$montant', '$date')";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert alert-success">Recette enregistrée avec succès</div>';
    } else {
        $message = '<div class="alert alert-danger">Erreur : ' . $sql . '<br>' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrer Recette</title>
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
        input[type="text"],
        input[type="date"],
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
        <h1>Enregistrer une nouvelle recette</h1>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_chauffeur">ID Chauffeur :</label>
                <input type="text" id="id_chauffeur" name="id_chauffeur" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_voiture">ID Voiture :</label>
                <input type="text" id="id_voiture" name="id_voiture" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="montant">Montant :</label>
                <input type="text" id="montant" name="montant" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>
