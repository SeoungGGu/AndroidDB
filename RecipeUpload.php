<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    if (!empty($_POST['userid']) && !empty($_POST['title']) && !empty($_POST['contents']) && !empty($_POST['category'])
        && !empty($_POST['difficulty']) && !empty($_POST['serving']) && !empty($_POST['image'])) {
        $userid = $_POST['userid'];
        $title = $_POST['title'];
        $contents = $_POST['contents'];
        $category = $_POST['category'];
        $difficulty = $_POST['difficulty'];
        $serving = $_POST['serving'];
        $base64Image = $_POST['image'];

        $path = 'images/' . date("d-m-Y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
        $decodedImage = base64_decode($base64Image);

        if (file_put_contents($path, $decodedImage)) {
            $imagePath = 'http://172.20.10.4/AndroidDB/' . $path;

            $sql = "INSERT INTO RECIPE (USER_ID, Title, Category, Difficulty, Servings, Contents, ImagePath)
            VALUES ('$userid', '$title', '$category', '$difficulty', '$serving', '$contents', '$imagePath')";

            if (mysqli_query($con, $sql)) {
                echo 'success';
            } else {
                echo 'Fail to insert to DataBase';
            }
        } else {
            echo 'Fail to upload image';
        }
    } else {
        echo 'Missing data';
    }
} else {
    echo 'DataBase connect failed';
}
?>
