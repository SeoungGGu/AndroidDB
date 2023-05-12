<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $UserID, $lgPassWord)
    {
        $UserID = $this->prepareData($UserID);
        $lgPassWord = $this->prepareData($lgPassWord);
        $this->sql = "select * from " . $table . " where UserID = '" . $UserID . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['UserID'];
            $dbpassword = $row['PassWord'];
            if ($dbusername == $UserID && password_verify($lgPassWord, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($table, $UserID, $UserEmail, $UserName, $PassWord)
    {
        $UserID = $this->prepareData($UserID);
        $UserEmail = $this->prepareData($UserEmail);
        $UserName = $this->prepareData($UserName);
        $PassWord = password_hash($PassWord, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (UserID, UserEmail, UserName, PassWord) VALUES ('" . $UserID . "','" . $UserEmail . "','" . $UserName . "','" . $PassWord . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
}
?>