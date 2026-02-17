<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Ajouter Produit</title>

    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <?php
        // Include navigation bar
        include 'include/nav.php';

        // Include database connection (PDO)
        include_once 'include/database.php';
    ?>

    <div class="container py20">

        <!-- Page heading -->
        <h4>Ajouter Produit</h4>

        <?php
            // This section is currently empty
            // You can add product insertion logic here later
        ?>

        <!-- Product form -->
        <form action="" method="post">

            <!-- Product name input -->
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Libelle</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="libelle">
                </div>
            </div>

            <!-- Product price input -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Prix</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="prix" min="0">
                </div>
            </div>

            <!-- Product discount input -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Discount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="discount" min="0" max="90">
                </div>
            </div>

            <?php
            // =====================================================
            // Fetch all categories from the database
            // =====================================================
            $categories = $pdo->query("SELECT * FROM categorie")
                              ->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <!-- Category selection dropdown -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Categories</label>
                <div class="col-sm-10">

                    <select name="categorie" class="form-control my-3">

                        <!-- Default option -->
                        <option value="">Choisire une categorie</option>

                        <?php
                        // Loop through categories and display them as options
                        foreach ($categories as $categorie) {
                            echo "<option value='" . $categorie['id'] . "'>"
                                 . $categorie['libelle'] .
                                 "</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>

            <!-- Submit button -->
            <input type="submit"
                   value="Ajouter Produit"
                   class="btn btn-primary btn my-2"
                   name="ajouter">

        </form>
    </div>

</body>
</html>
