<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py5">

        <?php
            if (isset($_POST['connexion'])){
                $login = $_POST['login'];
                $password = $_POST['password'];
                if(!empty($login)&&!empty($password)){
                    require_once 'include/database.php';
                    $sqlstate = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ? AND password = ?");
                    $sqlstate->execute([$login,$password]);
                    if($sqlstate->rowCount()>=1){
                        session_start();
                        $_SESSION['utilisateur']=$sqlstate->fetch();
                        header("location:admin.php");
                    }else{
        ?>
                        <div class="alert alert-danger" role="alert">
                            login ou password incorrects.
                        </div>
        <?php
                    }
                    
                }
            }
        ?>
        <h4>Connexion</h4>
        <form action="" method="post">
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" name="login">
                </div>
            </div>
            <div class="mb-3 row">
                <label  class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <input type="submit" value="Connexion" class="btn btn-primary btn my-2" name="connexion">
        </form>
    </div>




</body>
</html>