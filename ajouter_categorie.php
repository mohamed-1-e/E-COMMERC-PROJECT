<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Categorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


    <?php include 'include/nav.php' ?>
    <div class="container py20">
        <h4>Ajouter Ctaegorie</h4>
        <?php
            if(isset($_POST['ajouter'])){
                $libelle =$_POST['libelle'];
                $description = $_POST['description'];
                if(!empty($libelle)&&!empty($description)){
                    require_once 'include/database.php';
                    $sqlstate = $pdo->prepare("INSERT INTO categorie(libelle,description) VALUES(?,?)");
                    $sqlstate->execute([$libelle,$description]);
                    ?>
                    <div class="alert alert-success" role="alert">
                        La Categorie <?php echo $libelle   ?> ajoutée avec succès.
                    </div><?php
                }   
            }
        ?>
        <form action="" method="post">
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Libelle</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" name="libelle">
                </div>
            </div>
            <div class="mb-3 row">
                <label  class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
            <input type="submit" value="Connexion" class="btn btn-primary btn my-2" name="ajouter">
        </form>
    </div>
</body>
</html>