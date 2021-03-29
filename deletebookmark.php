<?php

$db_user = "root";
$db_pw = "7r46QGmp";
$server = "bookmarkdb";
$db = "bookmarks";
$username = $_COOKIE['username'];

if(isset($_POST['bookmark'])){
    $bookmark = $_POST['bookmark'];
    $conn = new mysqli($server, $db_user, $db_pw, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query="DELETE FROM  bookmarks  WHERE username=? AND bookmark=?";
    if ($stmt = mysqli_prepare($conn,$query)){
        mysqli_stmt_bind_param($stmt, "ss",$username, $bookmark);
        mysqli_stmt_execute($stmt);
    }else{
        echo mysqli_error($conn);
    }
}
else{
    echo "invalid bookmark";
}
