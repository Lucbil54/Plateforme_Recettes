<?php 
require_once __DIR__ . "/../controllers/utilitaireController.php";


$recettesController = SessionManager::retrieveRecettesController();

$btnSearch = filter_input(INPUT_POST, "btnSearch");
if (isset($btnSearch)) {
    $search = filter_input(INPUT_POST, "search");
    $categorie = filter_input(INPUT_POST, "selectCategorie");
    $recettesController->Filters($search, $categorie);

    // Enregistrez l'objet mis à jour dans la session
    SessionManager::storeRecettesController($recettesController);
}

$btnReset = filter_input(INPUT_POST, "btnReset");
if (isset($btnReset)) {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Recettes</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/images/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <?php require_once "inc/header.php"; ?>

    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/salad.png" alt="">
    </div>

    <div class="receipe-post-area section-padding-80">

        <!-- Receipe Post Search -->
        <div class="receipe-post-search mb-80">
            <div class="container">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <?php echo DisplaySelectCategorie(); ?>
                        </div>
                        <div class="col-12 col-lg-3">
                            <input type="search" name="search" placeholder="Search Receipies">
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" name="btnSearch" class="btn delicious-btn">Search</button>
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" name="btnReset" class="btn delicious-btn">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Affichage des recettes -->
    <section class="best-receipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>The Receipies</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                
            <?php echo $recettesController->DisplayRecettes(); ?>
               
            </div>
        </div>
    </section>

    <?php require_once "inc/footer.php"; ?>
</body>

</html>