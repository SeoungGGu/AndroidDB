<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['UserID']) && isset($_POST['PassWord'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("m_user", $_POST['UserID'], $_POST['PassWord'])) {
            echo "Login Success";
        } else echo "UserID or PassWord wrong";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>