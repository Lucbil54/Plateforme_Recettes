<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Recette</title>

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

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(assets/imgUpload/<?=$recette->cheminPhoto ?>);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2><?php echo $recette->titre ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
   

    <!-- Receipe Content Area -->
    <div class="receipe-content-area">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="receipe-headline my-5">
                        <div class="receipe-duration">
                            <h6>Prep: <?php echo $tempsCuisson->format("H:i"); ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Single Preparation Step -->
                    <div class="single-preparation-step d-flex">
                        <h4>01.</h4>
                        <p><?php echo $etapes->description; ?></p>
                    </div>

                </div>

                <!-- Ingredients -->
                <div class="col-12 col-lg-4">
                    <div class="ingredients">
                        <h4>Ingredients</h4>

                        <?php echo $displayIngredients; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST">
        <input type="submit" class="btn" name="btnUpdate" value="Modifier la recette">
        <input type="submit" class="btn" name="btnDelete" value="Supprimer la recette">
    </form>



    <?php require_once "inc/footer.php"; ?>

</body>

</html>