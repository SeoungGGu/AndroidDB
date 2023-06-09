<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];

        $sql = "SELECT RECIPE_ID, ImagePath FROM RECIPE WHERE USER_ID = '$userId' LIMIT 6";

        $result = mysqli_query($con, $sql);
        if ($result) {
            $response = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $recipeId = $row['RECIPE_ID'];
                $imagePath = $row['ImagePath'];

                $response[] = array(
                    'recipeid' => $recipeId,
                    'image' => $imagePath
                );
            }
            echo json_encode($response);
        } else {
            echo 'Query execution failed';
        }
    } else {
        echo 'Missing userId parameter';
    }
} else {
    echo 'Database connection failed';
}
?>