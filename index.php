<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Ajouter Utilisateur</title>

    <!-- Bootstrap CSS (for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <!-- Navigation bar -->
    <?php include 'include/nav.php' ?>

    <div class="container py20">

        <?php
        // =====================================================
        // VERIFY ADMIN ACCOUNT (LOGIN CHECK)
        // This block runs only when the user submits the form
        // =====================================================

        if (isset($_POST['connexion'])) {

            // Get form values (login + password)
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Check that inputs are not empty
            if (!empty($login) && !empty($password)) {

                // Include database connection file
                require_once 'include/database.php';

                // Prepare SQL query to search user in database
                $sqlstate = $pdo->prepare(
                    "SELECT * FROM utilisateur WHERE login = ? AND password = ?"
                );

                // Execute query with form values
                $sqlstate->execute([$login, $password]);

                // If user exists (at least 1 row found)
                if ($sqlstate->rowCount() >= 1) {

                    // Start session to store user info
                    session_start();

                    // Save user data inside session
                    $_SESSION['utilisateur'] = $sqlstate->fetch();

                    // Redirect user after successful login
                    header("location: connexion.php");

                } else {
                    // If login/password is incorrect, show error message
                    ?>
                    <div class="alert alert-danger" role="alert">
                        login ou password incorrects.
                    </div>
                    <?php
                }
            }
        }
        ?>

        <!-- Page heading -->
        <h4>Ajouter Utilisateur</h4>

        <!-- Login form -->
        <form action="" method="post">

            <!-- Email input -->
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="login">
                </div>
            </div>

            <!-- Password input -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <!-- Submit button -->
            <input type="submit"
                   value="Connexion"
                   class="btn btn-primary btn my-2"
                   name="connexion">
        </form>

    </div>
</body>
</html>
