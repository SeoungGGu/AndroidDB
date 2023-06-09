<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "cook_recipe";

$con = new mysqli($server_name, $user_name, $password, $db_name);
if ($con) {
    $tag = $_POST['tag'];
    $userSearchQuery = $_POST['UserSearchQuery'];

    $sql = "SELECT r.recipeid, r.title, u.name, r.difficulty, r.imageurl
            FROM RECIPE AS r
            INNER JOIN m_user AS u ON r.user_id = u.user_id";

    if ($tag != null) {
        $sql .= " WHERE r.category = '$tag'";
    }

    if ($userSearchQuery != null) {
        if ($tag != null) {
            $sql .= " AND (r.title LIKE '%$userSearchQuery%' OR u.name LIKE '%$userSearchQuery%')";
        } else {
            $sql .= " WHERE r.title LIKE '%$userSearchQuery%' OR u.name LIKE '%$userSearchQuery%'";
        }
    }

    $result = mysqli_query($con, $sql);
    if ($result) {
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $recipeId = $row['recipeid'];
            $title = $row['title'];
            $name = $row['name'];
            $difficulty = $row['difficulty'];
            $imageUrl = $row['imageurl'];

            $response[] = array(
                'recipeid' => $recipeId,
                'title' => $title,
                'name' => $name,
                'difficulty' => $difficulty,
                'imageurl' => $imageUrl
            );
        }
        echo json_encode($response);
    } else {
        echo 'Query execution failed';
    }
} else {
    echo 'Database connection failed';
}
?>
