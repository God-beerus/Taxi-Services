<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Recettes de Taxi - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #337ab7;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
        }
        li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        li a:hover {
            background-color: #e3e3e3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans le système de gestion de recettes de taxi</h1>
        <ul>
            <li><a href="ajouter_chauffeur.php">Ajouter Chauffeur</a></li>
            <li><a href="ajouter_voiture.php">Ajouter Voiture</a></li>
            <li><a href="enregistrer_recette.php">Enregistrer Recette</a></li>
            <li><a href="assigner_voiture.php">Assigner Voiture</a></li>
            <li><a href="ajouter_maintenance.php">Ajouter Maintenance</a></li>
            <li><a href="analyser_recettes.php">Analyser Recettes</a></li>
        </ul>
    </div>
</body>
</html>
