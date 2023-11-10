<?php 

$btnUpdate = filter_input(INPUT_POST, "btnUpdate");

if (isset($btnUpdate)) {
    $titre = filter_input(INPUT_POST, "titre");
    $tempsCuisson = filter_input(INPUT_POST,"tempsCuisson");
    $etapes = filter_input(INPUT_POST, "etapes");
    $selectedCategories = filter_input(INPUT_POST, 'selectCategories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $selectedIngredients = filter_input(INPUT_POST, 'selectIngredients', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    
    $image = $_FILES["image"];   
    UpdateRecetteController::UpdateRecette($idRecette, $titre, $tempsCuisson, $etapes, $selectedIngredients, $selectedCategories, $image);
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
    <title>Formulaire de recette</title>
       
    <!-- Favicon -->
    <link rel="icon" href="assets/images/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">

</head>

<body>

    <?php require_once "inc/header.php"; ?>

    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/salad.png" alt="">
    </div>

    <h1>Modifier une recette</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="titre">Nom de la recette:</label>
        <input type="text" id="titre" name="titre" value="<?=$old_recette->titre;?>"  required><br><br>

        <label for="tempsCuisson">Temps de cuisson:</label>
        <input type="time" id="tempsCuisson" name="tempsCuisson" value="<?=$old_recette->tempsCuisson;?>" required><br><br>

        <label for="ingredients">Ingrédients:</label>
        <?php echo DisplaySelectedIngredientsOfRecette($idRecette); ?>
        

        <label for="etapes">Etapes:</label>
        <textarea id="etapes" name="etapes" rows="4" cols="50" required><?=$old_etapes->description;?></textarea><br><br>

        <label for="categorie">Catégories:</label>
        <?php echo DisplaySelectedCategoriesOfRecette($idRecette); ?>

        <label for="image">Sélectionnez une image :</label>
        <input type="file" name="image" accept="image/*" required>


        <input type="submit" name="btnUpdate" value="Modifier la recette">
    </form>
       

    <?php require_once "inc/footer.php"; ?>
</body>

</html>