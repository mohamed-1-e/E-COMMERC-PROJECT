<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Produit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body>

<?php
include 'include/nav.php';
include_once 'include/database.php';

/* ✅ جيب categories مرة وحدة قبل الفورمولير */
$categories = $pdo->query("SELECT id, libelle FROM categorie ORDER BY libelle")
                  ->fetchAll(PDO::FETCH_ASSOC);

$success = "";
$error = "";

/* ✅ معالجة الفورمولير */
if (isset($_POST['ajouter'])) {

    $libelle = trim($_POST['libelle'] ?? '');
    $prix = $_POST['prix'] ?? '';
    $discount = $_POST['discount'] ?? 0;
    $categorie_id = $_POST['categorie'] ?? ''; // هذا هو id

    // ✅ تحويلات بسيطة
    $prix = is_numeric($prix) ? (float)$prix : -1;
    $discount = is_numeric($discount) ? (int)$discount : 0;
    $categorie_id = is_numeric($categorie_id) ? (int)$categorie_id : 0;

    // ✅ فاليديشن
    if ($libelle === '' || $prix < 0 || $categorie_id <= 0) {
        $error = "Veuillez remplir tous les champs correctement (categorie obligatoire).";
    } else {

        // ✅ INSERT صحيح: كنحدد الأعمدة (id و date_creation كيتدارو بوحدهم)
        $sqlstate = $pdo->prepare(
            "INSERT INTO produit (libelle, prix, discount, id_categorie)
             VALUES (?, ?, ?, ?)"
        );

        $sqlstate->execute([$libelle, $prix, $discount, $categorie_id]);

        $success = "Le produit <b>" . htmlspecialchars($libelle) . "</b> ajouté avec succès.";
    }
}
?>

<div class="container py-4">

    <h4>Ajouter Produit</h4>

    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">

        <div class="mb-3 mt-3 row">
            <label class="col-sm-2 col-form-label">Libelle</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="libelle" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Prix</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="prix" min="0" step="0.01" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Discount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="discount" min="0" max="90" value="0">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Categories</label>
            <div class="col-sm-10">
                <select name="categorie" class="form-control my-3" required>
                    <option value="">Choisir une categorie</option>

                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>">
                            <?= htmlspecialchars($cat['libelle']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <input type="submit"
               value="Ajouter Produit"
               class="btn btn-primary my-2"
               name="ajouter">

    </form>
</div>

</body>
</html>

