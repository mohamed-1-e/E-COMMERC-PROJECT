<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Ajouter Categorie</title>

    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <!-- Include navigation bar -->
    <?php include 'include/nav.php' ?>

    <div class="container py20">

        <!-- Page heading -->
        <h4>Ajouter Categorie</h4>

        <?php
        // =====================================================
        // CATEGORY INSERTION PROCESS
        // This code runs when the form is submitted
        // =====================================================

        if (isset($_POST['ajouter'])) {

            // Get form inputs
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];

            // Check that inputs are not empty
            if (!empty($libelle) && !empty($description)) {

                // Include database connection
                require_once 'include/database.php';

                // Prepare SQL query to insert a new category
                $sqlstate = $pdo->prepare(
                    "INSERT INTO categorie(libelle,description) VALUES(?,?)"
                );

                // Execute query with user values
                $sqlstate->execute([$libelle, $description]);
                ?>

                <!-- Success message -->
                <div class="alert alert-success" role="alert">
                    La Categorie <?php echo $libelle ?> ajoutée avec succès.
                </div>

                <?php
            }
        }
        ?>

        <!-- Category form -->
        <form action="" method="post">

            <!-- Category name input -->
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Libelle</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="libelle">
                </div>
            </div>

            <!-- Category description input -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>

            <!-- Submit button -->
            <input type="submit"
                   value="Ajoute categorie"
                   class="btn btn-primary btn my-2"
                   name="ajouter">

        </form>
    </div>

</body>
</html>
