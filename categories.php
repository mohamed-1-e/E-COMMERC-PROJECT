<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Liste des categories</title>

    <!-- Bootstrap CSS (for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <!-- Navigation bar -->
    <?php include 'include/nav.php' ?>

    <div class="container py-2">
        <h2>Liste des categories</h2>

        <a href="ajouter_categorie.php" class="btn btn-mo btn-success mb-3">Ajouter Categorie</a>

        <?php require_once 'include/database.php'; 
            $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_ASSOC);
            foreach($categories as $categorie) {
            
            }
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>operation</th>
                </tr>

            </thead>
            <tbody>
            <?php require_once 'include/database.php'; 
            $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_ASSOC);
            foreach($categories as $categorie) {
                ?>
                <tr>
                    <td><?php echo $categorie['id'] ?></td>
                    <td><?php echo $categorie['libelle'] ?></td>
                    <td><?php echo $categorie['description'] ?></td>
                    <td><?php echo $categorie['date_creation'] ?></td>
                    <td>
                        <input type="submit" value="Modifier" class="btn btn-sm btn-primary">
                        <input type="submit" value="Supprimer" class="btn btn-sm btn-danger">
                    </td>
                </tr>
                <?php
            }
        ?>

            </tbody>

        </table>

    </div>
</body>
</html>