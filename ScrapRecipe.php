<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    $recipeId = $_POST['recipeId'];
    $userId = $_POST['userId'];

    $sql = "INSERT INTO ScrapRecipe (USER_ID, RECIPE_ID) VALUES ('$userId', $recipeId)";

    if (mysqli_query($con, $sql)) {
        echo "Scrap data stored successfully";
    } else {
        echo "Error storing scrap data: " . mysqli_error($con);
    }
} else {
    echo 'Database connection failed';
}
?>
