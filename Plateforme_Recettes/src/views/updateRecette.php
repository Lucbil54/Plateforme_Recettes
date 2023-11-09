<?php 

$btnCreate = filter_input(INPUT_POST, "btnCreate");

if (isset($btnCreate)) {
    $titre = filter_input(INPUT_POST, "titre");
    $tempsCuisson = filter_input(INPUT_POST,"tempsCuisson");
    $ingredients = $_POST["selectIngredients"];
    $etapes = filter_input(INPUT_POST, "etapes");
    $categorie = filter_input(INPUT_POST,"selectCategories");
    
    $image = $_FILES["image"];           

    CreateRecetteController::CreateRecette($titre, $tempsCuisson, $etapes, $ingredients, $categorie, $image);
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

    <h1>Créer une recette</h1>
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