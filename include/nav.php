<?php
// =====================================================
// START SESSION
// This is required to access $_SESSION variables
// =====================================================
session_start();

// =====================================================
// CHECK IF USER IS CONNECTED (LOGGED IN)
// If session "utilisateur" exists, user is connected
// =====================================================
$connecte = false;

if (isset($_SESSION['utilisateur'])) {
    $connecte = true;
}
?>

<!-- =====================================================
     NAVIGATION BAR (Bootstrap Navbar)
     Shows different links depending on login status
===================================================== -->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <!-- Website logo / name -->
    <a class="navbar-brand" href="#">E-COMMERCE</a>

    <!-- Navbar toggle button for mobile view -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <!-- Link always visible -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">
            Ajouter utilisateur
          </a>
        </li>

        <?php
        // =====================================================
        // DISPLAY MENU OPTIONS BASED ON LOGIN STATUS
        // =====================================================

        if ($connecte) {
            // User is logged in
        ?>
            <!-- Admin-only links -->
            <li class="nav-item">
              <a class="nav-link" href="ajouter_categorie.php">
                Ajouter Categorie
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="ajouter_produit.php">
                Ajouter Produit
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="deconnexion.php">
                Deconnexion
              </a>
            </li>

        <?php
        } else {
            // User is NOT logged in
        ?>
            <!-- Login link -->
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">
                Connexion
              </a>
            </li>

        <?php
        }
        ?>

      </ul>
    </div>
  </div>
</nav>
