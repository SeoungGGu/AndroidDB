<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cook_recipe";

// POST 요청에서 전달된 userid 가져오기
$userid = $_POST['userid'];

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recipe 테이블에서 해당 userid에 대한 레시피 정보 조회
$query = "SELECT RECIPE.RECIPE_ID, RECIPE.Title, RECIPE.Category, RECIPE.ImagePath 
          FROM RECIPE 
          WHERE RECIPE.USER_ID = '$userid'";

$result = $conn->query($query);

// 결과 확인 및 JSON 형태로 변환
if ($result->num_rows > 0) {
    $response = array();
    while ($row = $result->fetch_assoc()) {
        $recipeid = $row["RECIPE_ID"];
        $title = $row["Title"];
        $category = $row["Category"];
        $image = $row["ImagePath"];

        $recipe = array("recipeid" => $recipeid, "title" => $title, "category" => $category, "imageurl" => $image);
        array_push($response, $recipe);
    }
    echo json_encode($response);
} else {
    echo "0 results";
}

$conn->close();

?>
