<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['UserID']) && isset($_POST['UserEmail']) && isset($_POST['UserName']) && isset($_POST['PassWord'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("m_user", $_POST['UserID'], $_POST['UserEmail'], $_POST['UserName'], $_POST['PassWord'])) {
            echo "Sign Up Success";
        } else echo "Sign up Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
