<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Liste des produit</title>

    <!-- Bootstrap CSS (for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <!-- Navigation bar -->
    <?php include 'include/nav.php' ?>

    <div class="container py-20">
        
        <!-- Page heading -->
        <h4>List des produits</h4>

        <a href="ajouter_produit.php" class="btn btn-mo btn-success mb-3">Ajouter Produit</a>

        <table class="table table-hover">
            <thead>
                <th>#ID</th>
                <th>Libelle</th>
                <th>Prix</th>
                <th>Discount</th>
                <th>Categorie</th>
                <th>Date Creation</th>
                <th>Operation</th>
            </thead>
            <tbody>
            <?php require_once 'include/database.php';
            $produits = $pdo->query("SELECT p.*, c.libelle as nom_categorie FROM produit p LEFT JOIN categorie c ON p.id_categorie = c.id")->fetchAll(PDO::FETCH_ASSOC);
            //name of categorie is in categorie table, we need to join tables to get it
            
            foreach($produits as $produit) {
                $prix_final = $produit['prix'] * (1 - $produit['discount'] / 100);
                ?>
                <tr>
                    <td><?php echo $produit['id'] ?></td>
                    <td><?php echo $produit['libelle'] ?></td>
                    <td><?php echo $prix_final . " DH" ?></td>
                    <td><?php echo $produit['discount'] ?></td>
                    <td><?php echo $produit['nom_categorie'] ?></td>
                    <td><?php echo $produit['date_creation'] ?></td>
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

        <?php
        ?>


    </div>
</body>
</html>
