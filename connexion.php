<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Connexion</title>

    <!-- Bootstrap CSS (for styling the page) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

    <!-- Include navigation bar -->
    <?php include 'include/nav.php' ?>

    <div class="container py5">

        <?php
        // =====================================================
        // LOGIN PROCESS
        // This code runs when the user submits the login form
        // =====================================================

        if (isset($_POST['connexion'])) {

            // Get values entered in the form
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Check that login and password are not empty
            if (!empty($login) && !empty($password)) {

                // Include database connection file
                require_once 'include/database.php';

                // Prepare SQL query to verify user credentials
                $sqlstate = $pdo->prepare(
                    "SELECT * FROM utilisateur WHERE login = ? AND password = ?"
                );

                // Execute query using the form inputs
                $sqlstate->execute([$login, $password]);

                // If a user is found in the database
                if ($sqlstate->rowCount() >= 1) {

                    // Start session to store user information
                    session_start();

                    // Save user data in session
                    $_SESSION['utilisateur'] = $sqlstate->fetch();

                    // Redirect user to admin dashboard page
                    header("location: admin.php");

                } else {
                    // If credentials are incorrect, show error message
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
        <h4>Connexion</h4>

        <!-- Login form -->
        <form action="" method="post">

            <!-- Email input field -->
            <div class="mb-3 mt-3 row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="login">
                </div>
            </div>

            <!-- Password input field -->
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
