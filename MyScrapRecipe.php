<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    $userid = $_POST['userid'];

    $sql = "SELECT * FROM RECIPE WHERE RECIPE_ID IN (SELECT RECIPE_ID FROM ScrapRecipe WHERE USER_ID = '$userid')";

    $result = mysqli_query($con, $sql);
    $response = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $recipeid = $row['RECIPE_ID'];
            $title = $row['Title'];
            $category = $row['Category'];
            $imageurl = $row['ImagePath'];

            $scrap = array('recipeid' => $recipeid, 'title' => $title, 'category' => $category, 'imageurl' => $imageurl);
            array_push($response, $scrap);
        }
        echo json_encode($response);
    } else {
        echo "No scrap recipes found";
    }
} else {
    echo 'Database connection failed';
}
?>
