<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py5">

        <?php
            session_start();
            if(!isset($_SESSION['utilisateur'])){
                header('location: connexion.php');
            }
        ?>
        <h3>Bonjour : <?php echo $_SESSION['utilisateur']['login']; ?>

        </h3>
    </div>
</body>
</html>