<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    $recipeId = $_POST['recipeId'];

    $sql = "SELECT r.title, r.category, r.servings, r.difficulty, r.contents, r.imageurl, GROUP_CONCAT(i.name SEPARATOR ', ') AS ingredients
            FROM RECIPE AS r
            LEFT JOIN INGREDIENT AS i ON r.ingredient_id = i.ingredient_id
            WHERE r.recipe_id = $recipeId";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $response = array(
            'title' => $row['title'],
            'category' => $row['category'],
            'Servings' => $row['servings'],
            'Difficultly' => $row['difficulty'],
            'ingredients' => $row['ingredients'],
            'Contents' => $row['contents'],
            'imageurl' => $row['imageurl']
        );

        echo json_encode($response);
    } else {
        echo 'Query execution failed';
    }
} else {
    echo 'Database connection failed';
}
?>
